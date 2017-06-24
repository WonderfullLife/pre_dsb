<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class logController extends Controller
{

    public function cekIndexLra($tahun)
    {
        $cek = $this->getIndexLraLokal($tahun);
        $core = $this->getIndexLraCore($tahun);
        if ($cek === null) {
            $this->simpanInit($core, 'lra');
        }
        $lokal = $this->getIndexLraLokal($tahun);
        $beda = array_map('unserialize', array_diff(array_map('serialize', $core), array_map('serialize', $lokal['data'])));
        $dt = array_replace_recursive($lokal['belum_mapping'], $beda);
        $this->simpanIndexLra($dt, $lokal['cek']);
        return $beda;
    }

    public function cekIndexApbd($tahun)
    {
        $cek = $this->getIndexApbdLokal($tahun);
        $core = $this->getIndexApbdCore($tahun);

        if ($cek === null) {
            $this->simpanInit($core, 'apbd');
        }
        $lokal = $this->getIndexApbdLokal($tahun);

        $beda = array_map('unserialize', array_diff(array_map('serialize', $core), array_map('serialize', $lokal['data'])));
        //return $beda;
        $dt = array_replace_recursive($lokal['belum_mapping'], $beda);
        //return $dt;
        return $this->simpanIndexApbd($dt, $lokal['cek']);
    }

    public function getIndexApbdCore($tahun)
    {
        $core = DB::connection('pgsql')
            ->table('apbd')
            ->select(DB::raw('max(apbdindex) as apbdindex, kodesatker,kodedata, tahunanggaran'))
            ->where([
                'tahunanggaran' => $tahun,
                'jeniscoa' => 1
            ])
            ->groupBy('kodesatker', 'tahunanggaran', 'kodedata')
            ->get();
        foreach ($core as $item) {
            $data[$item->kodedata . $item->tahunanggaran . $item->kodesatker] = [
                'tahun' => $item->tahunanggaran,
                'kodesatker' => $item->kodesatker,
                'kodedata' => (int)$item->kodedata,
                'indexcore' => (int)$item->apbdindex,

            ];
        }

        return $data;
    }

    public function getIndexLraCore($tahun)
    {
        $core = DB::connection('pgsql')
            ->table('realisasiapbd')
            ->select(DB::raw('max(apbdindex) as apbdindex, kodesatker, tahunanggaran, bulan'))
            ->where([
                'tahunanggaran' => $tahun,
                'jeniscoa' => 1
            ])
            ->groupBy('kodesatker', 'tahunanggaran', 'bulan')
            ->get();
        foreach ($core as $item) {
            $data[$item->tahunanggaran . $item->bulan . $item->kodesatker] = [
                'tahun' => $item->tahunanggaran,
                'bulan' => $item->bulan,
                'kodesatker' => $item->kodesatker,
                'indexcore' => (int)$item->apbdindex,
            ];
        }

        return $data;
    }


    public function getIndexApbdLokal($tahun)
    {
        $lokal = DB::table('log_index_apbd')
            ->where([
                'tahun' => $tahun
            ])
            ->get();

        if (!$lokal->isEmpty()) {
            foreach ($lokal as $item) {
                if ($item->status_mapping == 0 or $item->status_mapping = 2) {
                    $data['belum_mapping'][$item->kodedata . $item->tahun . $item->kodesatker] = [
                        'tahun' => (int)$item->tahun,
                        'kodesatker' => $item->kodesatker,
                        'kodedata' => (int)$item->kodedata,
                        'indexcore' => (int)$item->indexcore
                    ];
                }
                $data['data'][$item->kodedata . $item->tahun . $item->kodesatker] = [
                    'tahun' => (int)$item->tahun,
                    'kodesatker' => $item->kodesatker,
                    'kodedata' => (int)$item->kodedata,
                    'indexcore' => (int)$item->indexlokal,
                ];

                $data['cek'][$item->kodedata . $item->tahun . $item->kodesatker] = (int)$item->indexcore;
            }
        } else {
            return null;
        }

        return $data;

    }

    public function getIndexlraLokal($tahun)
    {
        $lokal = DB::table('log_index_lra')
            ->where([
                'tahun' => $tahun
            ])
            ->get();


        if (!$lokal->isEmpty()) {
            foreach ($lokal as $item) {
                if ($item->status_mapping == 0 or $item->status_mapping == 2) {
                    $data['belum_mapping'][$item->tahun . $item->bulan . $item->kodesatker] = [
                        'tahun' => $item->tahun,
                        'bulan' => $item->bulan,
                        'kodesatker' => $item->kodesatker,
                        'indexcore' => $item->indexcore
                    ];
                }
                $data['data'][$item->tahun . $item->bulan . $item->kodesatker] = [
                    'tahun' => $item->tahun,
                    'bulan' => $item->bulan,
                    'kodesatker' => $item->kodesatker,
                    'indexcore' => $item->indexcore,
                ];

                $data['cek'][$item->tahun . $item->bulan . $item->kodesatker] = $item->indexcore;
            }
        } else {
            return null;
        }

        return $data;

    }

    public function simpanIndexLra($data, $cek)
    {
        $update = 0;
        foreach ($data as $key => $item) {
            if (array_key_exists($item['tahun'] . $item['bulan'] . $item['kodesatker'], $cek)) {
                if ($item['indexcore'] != $cek[$item['tahun'] . $item['bulan'] . $item['kodesatker']]) {
                    DB::table('log_index_lra')
                        ->where([
                            'tahun' => $item['tahun'],
                            'bulan' => $item['bulan'],
                            'kodesatker' => $item['kodesatker']
                        ])
                        ->update([
                            'indexcore' => $item['indexcore'],
                            'status_mapping' => 0
                        ]);
                    $update = $update + 1;
                }
                unset($data[$key]);
            }
        }

        DB::table('log_index_lra')->insert(array_values($data));
    }

    public function simpanIndexApbd($data, $cek)
    {

        $update = 0;
        foreach ($data as $key => $item) {
            if (array_key_exists($item['kodedata'] . $item['tahun'] . $item['kodesatker'], $cek)) {
                if ($item['indexcore'] != $cek[$item['kodedata'] . $item['tahun'] . $item['kodesatker']]) {
                    DB::table('log_index_apbd')
                        ->where([
                            'tahun' => $item['tahun'],
                            'kodesatker' => $item['kodesatker'],
                            'kodedata' => $item['kodedata']
                        ])
                        ->update([
                            'indexcore' => $item['indexcore'],
                            'status_mapping' => 0
                        ]);
                    $update = $update + 1;
                }
                unset($data[$key]);
            }
        }

        DB::table('log_index_apbd')->insert(array_values($data));
        return $data;
    }

    public function simpanInit($data, $jenis)
    {
        //return $data;
        DB::table('log_index_' . $jenis)->insert(array_values($data));
    }

}
