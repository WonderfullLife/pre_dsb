<?php
/**
 * Created by PhpStorm.
 * User: Plue
 * Date: 03/04/2017
 * Time: 16.24
 */

namespace App\Http\Helper;

use DB;
use Carbon\Carbon;

class log
{

    public function cekIndex($jenis, $tahun)
    {
        $data = '';
        switch ($jenis) {
            case($jenis == 'lra'):
                $data = $this->cekIndexLra($tahun);
                break;
            case($jenis == 'apbd'):
                $data = $this->cekIndexApbd($tahun);
                break;
        }

        return $data;
    }

    public function cekIndexApbd($tahun)
    {

    }

    public function cekIndexLra($tahun)
    {
        $cek = $this->getIndexLraLokal($tahun);
        $core = $this->getIndexLraCore($tahun);
        $w3 = null;
        if ($cek === null) {
            $this->simpanInit($core, 'lra');
        }
        $lokal = $this->getIndexLraLokal($tahun);
        $beda = array_map('unserialize', array_diff(array_map('serialize', $core), array_map('serialize', $lokal['data'])));
        $output = $this->simpanIndexLra($beda, $lokal['data']);
        return $output;
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

    public function getIndexlraLokal($tahun)
    {
        $lokal = DB::table('log_index_lra_sementara')
            ->where([
                'tahun' => $tahun
            ])
            ->get();

        $data = null;
        $data['belum_notif'] = [];
        if (!$lokal->isEmpty()) {
            foreach ($lokal as $item) {
                if ($item->status_notif == 0) {
                    $data['belum_notif'][$item->tahun . $item->bulan . $item->kodesatker] = [
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
                    'indexcore' => $item->indexcore
                ];
            }
        } else {
            return null;
        }
        return $data;
    }

    public function simpanIndexLra($data, $cek)
    {
        $cupdate = 0;
        $update = array_intersect_key($data, $cek);
        $insert = array_diff_key($data, $cek);
        if (count($update) != 0) {
            foreach ($update as $key => $item) {
                DB::table('log_index_lra_sementara')
                    ->where([
                        'tahun' => $item['tahun'],
                        'bulan' => $item['bulan'],
                        'kodesatker' => $item['kodesatker']
                    ])
                    ->update([
                        'indexcore' => $item['indexcore'],
                        'status_notif' => 0
                    ]);
                $cupdate = $cupdate + 1;
            }
        }

        if (count($insert) != 0) {
            DB::table('log_index_lra_sementara')->insert(array_values($insert));
        }

        return ['update' => $cupdate, 'insert' => count($insert)];
    }

    public function simpanInit($data, $jenis)
    {
        //return $data;
        DB::table('log_index_' . $jenis . '_sementara')->insert(array_values($data));
    }
}