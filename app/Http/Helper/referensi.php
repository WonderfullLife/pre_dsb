<?php
/**
 * Created by PhpStorm.
 * User: Plue
 * Date: 03/04/2017
 * Time: 09.22
 */

namespace App\Http\Helper;

use DB;

class referensi
{
    protected $format;

    public function __construct(format $format)
    {
        $this->format = $format;
    }

    public function getRefJenis($tahun)
    {
        $data = DB::table('ref_jenis as a')
            ->select(DB::raw('
                TRIM(a.kd_akun) as kd_akun,
                TRIM(c.akun) as nm_akun,
                TRIM(a.kd_kelompok) as kd_kelompok,
                TRIM(b.kelompok) as nm_kelompok,
                TRIM(a.kd_jenis) as kd_jenis,
                TRIM(a.jenis) as nm_jenis
                '))
            ->join('ref_kelompok as b', DB::raw('concat(a.kd_akun,a.kd_kelompok)'), '=', DB::raw('CONCAT(b.kd_akun,b.kd_kelompok)'))
            ->join('ref_akun as c', 'b.kd_akun', '=', 'c.kd_akun')
            ->where('tahun', '=', $tahun)
            ->get();

        $output = null;
        foreach ($data as $item) {
            $output[$this->format->bersih($item->kd_akun . $item->kd_kelompok . $item->kd_jenis . $item->nm_jenis)] = [
                'kd_akun' => $item->kd_akun,
                'nm_akun' => $item->nm_akun,
                'kd_kelompok' => $item->kd_kelompok,
                'nm_kelompok' => $item->nm_kelompok,
                'kd_jenis' => $item->kd_jenis,
                'nm_jenis' => $item->nm_jenis
            ];
        }
        return $output;
    }

    public function getRefUrusan($tahun)
    {
        $data = DB::table('ref_urusan')
            ->select('kd_urusan', 'kd_fungsi', 'fungsi', 'urusan', 'tahun')
            ->where('tahun', '=', $tahun)
            ->get();
        $output = null;
        foreach ($data as $item) {
            $output[$item->tahun][$this->format->bersih($item->kd_urusan . $item->urusan)] = [
                'kd_urusan' => $item->kd_urusan,
                'nm_urusan' => $item->urusan,
                'kd_fungsi' => $item->kd_fungsi,
                'nm_fungsi' => $item->fungsi
            ];
        }

        return $output;
    }


    public function getTempJenis($tahun)
    {
        $data = DB::table('temp_jenis')
            ->where([
                'status_map' => 0,
                'tahun' => $tahun
            ])
            /*
            ->orWhere([
                'status_map'=>2,
                'tahun'=>$tahun
            ])
            */
            ->get();
        $output = [];
        if (!$data->isEmpty()) {
            foreach ($data as $item) {
                $output[$this->format->bersih($item->kodeakunutama . $item->kodeakunkelompok . $item->kodeakunjenis . $item->namaakunjenis)] = [
                    'id' => $item->id,
                ];
            }
        }
        return $output;
    }

    public function getTempUrusan($tahun)
    {
        $data = DB::table('temp_urusan')
            ->select(DB::raw('TRIM(kodeurusanprogram) as kodeurusanprogram, TRIM(namaurusanprogram) as namaurusanprogram, id, tahun'))
            ->where([
                'status_map' => 0,
                'tahun' => $tahun
            ])
            ->orWhere([
                'status_map' => 2,
            ])
            ->get();
        $output = [];
        if (!$data->isEmpty()) {
            foreach ($data as $item) {
                $output[$this->format->bersih($item->kodeurusanprogram . $item->namaurusanprogram)] = [
                    'id' => $item->id
                ];
            }
        }

        return $output;
    }

    public function getReferensiTemp($tahun)
    {
        $output['jenis'] = $this->getTempJenis($tahun);
        $output['urusan'] = $this->getTempUrusan($tahun);
        return $output;
    }

    public function getReferensiMap($tahun)
    {
        $refJenis = $this->getRefJenis($tahun);
        $refUrusan = $this->getRefUrusan($tahun);
        $mapJenis = $this->getMapJenis($tahun);
        $mapUrusan = $this->getMapUrusan($tahun);
        $output['jenis'] = array_merge($refJenis, $mapJenis);
        $output['urusan'] = array_merge($refUrusan, $mapUrusan);
        return $output;
    }

    public function getMapUrusan($tahun)
    {
        $data = DB::table('map_urusan as a')
            ->select(DB::raw('TRIM(a.kodeurusanprogram) as kd_urusan,
                TRIM(a.namaurusanprogram) as nm_urusan,
                TRIM(a.kd_urusan) as kd_urusan,
                TRIM(b.kd_fungsi) as kd_fungsi,
                TRIM(b.fungsi) as nm_fungsi,
                a.id'))
            ->join('ref_urusan as b', 'a.kd_urusan', '=', 'b.kd_urusan')
            ->where('a.tahun', '=', $tahun)
            ->get();
        $output = [];
        if (!$data->isEmpty()) {
            foreach ($data as $item) {
                $output[$item->kd_urusan . $item->nm_urusan] = [
                    'kd_urusan' => $item->kd_urusan,
                    'nm_urusan' => $item->nm_urusan,
                    'id' => $item->id,
                    'kd_fungsi' => $item->kd_fungsi,
                    'nm_fungsi' => $item->nm_fungsi
                ];
            }
        }
        return $output;
    }

    public function getMapJenis($tahun)
    {
        $data = DB::table('map_jenis as a')
            ->select(
                DB::raw('TRIM(a.kodeakunutama) as kodeakunutama,
                TRIM(a.kodeakunkelompok) as kodeakunkelompok,
                TRIM(a.kodeakunjenis) as kodeakunjenis,
                TRIM(a.namaakunjenis) as namaakunjenis,
                TRIM(a.kd_akun) as kd_akun,
                TRIM(d.akun) as nm_akun,
                TRIM(a.kd_kelompok) as kd_kelompok,
                TRIM(c.kelompok) as nm_kelompok,
                TRIM(a.kd_jenis) as kd_jenis,
                TRIM(b.jenis) as nm_jenis,
                a.id')
            )
            ->join('ref_jenis as b', DB::raw('concat(a.kd_akun,a.kd_kelompok,a.kd_jenis)'), '=', DB::raw('CONCAT(b.kd_akun,b.kd_kelompok,b.kd_jenis)'))
            ->join('ref_kelompok as c', DB::raw('concat(b.kd_akun,b.kd_kelompok)'), '=', DB::raw('CONCAT(c.kd_akun,c.kd_kelompok)'))
            ->join('ref_akun as d', 'b.kd_akun', '=', 'd.kd_akun')
            ->where('a.tahun', '=', $tahun)
            ->get();
        $output = [];
        foreach ($data as $item) {
            $output[$item->kodeakunutama . $item->kodeakunkelompok . $item->kodeakunjenis . $item->namaakunjenis] = [
                'kd_akun' => $item->kd_akun,
                'nm_akun' => $item->nm_akun,
                'kd_kelompok' => $item->kd_kelompok,
                'nm_kelompok' => $item->nm_kelompok,
                'kd_jenis' => $item->kd_jenis,
                'nm_jenis' => $item->nm_jenis,
                'id' => $item->id
            ];
        }
        return $output;
    }

    public function getTempMap($jenis, $kodesatker, $tahun)
    {
        $tabel = 'temp_' . $jenis . '_map';
        $kolom = 'temp_' . $jenis . '_id';
        $data = DB::table($tabel)->select($kolom)->where(['kodesatker' => $kodesatker, 'tahun' => $tahun])->get();
        return array_values($data->pluck($kolom)->toArray());
    }

    public function SimpanTempMap($data)
    {

        foreach ($data as $jenis => $map) {
            $tabel = 'temp_' . $jenis . '_map';
            $kolom = 'temp_' . $jenis . '_id';
            DB::table($tabel)
                ->insert($data[$jenis]);
        }

        return true;
    }

    public function getHomeTempJenis($tahun)
    {
        $data = DB::table('temp_jenis')
            ->where([
                'status_map' => 0,
                'tahun' => $tahun
            ])
            ->orWhere([
                'status_map' => 2,
            ])
            ->get();
        $output = [];
        if (!$data->isEmpty()) {
            foreach ($data as $item) {
                $output[] = [
                    'id' => $item->id,
                    'kodeakun' => $this->format->bersih($item->kodeakunutama . $item->kodeakunkelompok . $item->kodeakunjenis),
                    'uraian' => $this->format->bersihSelainSpasi($item->namaakunjenis)
                ];
            }
        }
        return $output;
    }

    public function getHomeTempUrusan($tahun)
    {
        $data = DB::table('temp_urusan')
            ->select(DB::raw('TRIM(kodeurusanprogram) as kodeurusanprogram, TRIM(namaurusanprogram) as namaurusanprogram, id, tahun'))
            ->where([
                'status_map' => 0,
                'tahun' => $tahun
            ])
            ->orWhere([
                'status_map' => 2,
            ])
            ->get();
        $output = [];
        if (!$data->isEmpty()) {
            foreach ($data as $item) {
                $output[] = [
                    'id' => $item->id,
                    'kodeurusan' => $item->kodeurusanprogram,
                    'uraian' => $this->format->bersihSelainSpasi($item->namaurusanprogram)
                ];
            }
        }

        return $output;
    }

    public function getSatkerTemp($jenis, $kodesatker, $tahun)
    {
        foreach ($jenis as $item) {
            $tabel1 = 'temp_' . $item . '_map as a';
            $tabel2 = 'map_' . $item . ' as b';
            $col1 = 'a.temp_' . $item . '_id';
            $data[$item] = DB::table($tabel1)
                ->join($tabel2, $col1, '=', 'b.id')
                ->where([
                    'a.tahun' => $tahun,
                    'a.kodesatker' => $kodesatker
                ])->get();
        }

        return $data;
    }

    public function getTempJenisLimit($tahun, $posisi, $jumlah)
    {
        $data = DB::table('temp_jenis')
            ->where([
                'status_map' => 0,
                'tahun' => $tahun
            ])
            ->orWhere([
                'status_map' => 2,
            ])
            ->skip($posisi)
            ->take($jumlah)
            ->get();
        $output = [];
        if (!$data->isEmpty()) {
            foreach ($data as $item) {
                $output[] = [
                    'id' => $item->id,
                    'kd_concat' => $item->kodeakunutama . $item->kodeakunkelompok . $item->kodeakunjenis,
                    'kd_text' => $this->format->bersihSelainSpasi($item->namaakunjenis)
                ];
            }
        }
        return [
            'cat' => [
                'cur_posisi' => $posisi,
                'next_posisi' => (count($output) == 0 ? $posisi : $posisi + $jumlah),
                'tahun' => $tahun,
                'limit' => $jumlah
            ],
            'data' => $output
        ];
    }

    public function getTempUrusanLimit($tahun, $posisi, $jumlah)
    {
        $data = DB::table('temp_urusan')
            ->select(DB::raw('TRIM(kodeurusanprogram) as kodeurusanprogram, TRIM(namaurusanprogram) as namaurusanprogram, id, tahun'))
            ->where([
                'status_map' => 0,
                'tahun' => $tahun
            ])
            ->orWhere([
                'status_map' => 2,
            ])
            ->skip($posisi)
            ->take($jumlah)
            ->get();
        $output = [];
        if (!$data->isEmpty()) {
            foreach ($data as $item) {
                $output[] = [
                    'id' => $item->id,
                    'kodeurusan' => $item->kodeurusanprogram,
                    'uraian' => $this->format->bersihSelainSpasi($item->namaurusanprogram)
                ];
            }
        }

        return $output;
    }

    public function getRefJenisTahun($tahun)
    {
        $data = DB::table('ref_jenis as a')
            ->select(DB::raw('
                TRIM(a.kd_akun) as kd_akun,
                TRIM(c.akun) as nm_akun,
                TRIM(a.kd_kelompok) as kd_kelompok,
                TRIM(b.kelompok) as nm_kelompok,
                TRIM(a.kd_jenis) as kd_jenis,
                TRIM(a.jenis) as nm_jenis
                '))
            ->join('ref_kelompok as b', DB::raw('concat(a.kd_akun,a.kd_kelompok)'), '=', DB::raw('CONCAT(b.kd_akun,b.kd_kelompok)'))
            ->join('ref_akun as c', 'b.kd_akun', '=', 'c.kd_akun')
            ->get();

        $output = null;
        foreach ($data as $item) {
            $output[] = [
                'id' => $item->kd_akun . '.' . $item->kd_kelompok . '.' . $item->kd_jenis,
                'text' => $item->kd_akun . $item->kd_kelompok . $item->kd_jenis . ' ' . $item->nm_jenis,
            ];
        }
        return $output;
    }

    public function getSatkerTempJenis($id)
    {
        $data = DB::table('temp_jenis_map as a')
            ->select('a.kodesatker', 'b.urpemda')
            ->where('temp_jenis_id', '=', $id)
            ->join('ref_pemda as b', 'a.kodesatker', '=', 'b.kodesatker')
            ->get();
        foreach ($data as $item) {
            $output[] = [
                'value' => $item->kodesatker,
                'text' => $item->urpemda
            ];
        }

        return $output;
    }
}