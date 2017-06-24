<?php
/**
 * Created by PhpStorm.
 * User: Plue
 * Date: 03/04/2017
 * Time: 10.11
 */

namespace App\Http\Helper;

use DB;

class sikd
{
    public function getLra($tahun, $apbdindex, $coa)
    {
        ini_set('memory_limit', '2048M');
        $con = DB::connection('pgsql');
        $a = $con->table('v_realisasikoderekapbd')
            ->select(
                'apbdindex',
                'kodesatker',
                'kodepemda',
                'namapemda',
                'tahunanggaran',
                'bulan',
                'tglpengiriman',
                'jeniscoa',
                'namaaplikasi',
                'pengembangaplikasi',
                'kegiatanindex',
                DB::raw('TRIM(kodeurusanprogram) as kodeurusanprogram'),
                DB::raw('TRIM(namaurusanprogram) as namaurusanprogram'),
                'kodeurusanpelaksana',
                'namaurusanpelaksana',
                'kodeskpd',
                'namaskpd',
                'kodeprogram',
                'namaprogram',
                'kodekegiatan',
                'namakegiatan',
                'kodefungsi',
                'namafungsi',
                DB::raw('TRIM(kodeakunutama) as kodeakunutama'),
                DB::raw('TRIM(namaakunutama) as namaakunutama'),
                DB::raw('TRIM(kodeakunkelompok) as kodeakunkelompok'),
                DB::raw('TRIM(namaakunkelompok) as namaakunkelompok'),
                DB::raw('TRIM(kodeakunjenis) as kodeakunjenis'),
                DB::raw('TRIM(namaakunjenis) as namaakunjenis'),
                'kodeakunobjek',
                'namaakunobjek',
                'kodeakunrincian',
                'namaakunrincian',
                'kodeakunsub',
                'namaakunsub',
                'nilaianggaran'
            )->where([
                'jeniscoa' => $coa,
                'apbdindex' => $apbdindex,
                'tahunanggaran' => $tahun
            ])
            ->get();

        $dt = [];
        $sotk = $this->cekSotk($tahun);
        foreach ($a as $item) {
            $b = [
                'apbdindex' => $item->apbdindex,
                'kodesatker' => $item->kodesatker,
                'kodepemda' => $item->kodepemda,
                'namapemda' => $item->namapemda,
                'tahunanggaran' => $item->tahunanggaran,
                'bulan' => $item->bulan,
                'jeniscoa' => $item->jeniscoa,
                'tglpengiriman' => $item->tglpengiriman,
                'namaaplikasi' => $item->namaaplikasi,
                'pengembangaplikasi' => $item->pengembangaplikasi,
                'kodeurusanprogram' => $item->kodeurusanprogram,
                'namaurusanprogram' => $item->namaurusanprogram,
                'kodeurusanpelaksana' => $item->kodeurusanpelaksana,
                'namaurusanpelaksana' => $item->namaurusanpelaksana,
                'kodeskpd' => $item->kodeskpd,
                'namaskpd' => $item->namaskpd,
                'kodeprogram' => $item->kodeprogram,
                'namaprogram' => $item->namaprogram,
                'kodekegiatan' => $item->kodekegiatan,
                'namakegiatan' => $item->namakegiatan,
                'kodefungsi' => $item->kodefungsi,
                'namafungsi' => $item->namafungsi,
                'kodeakunutama' => $item->kodeakunutama,
                'namaakunutama' => $item->namaakunutama,
                'kodeakunkelompok' => $item->kodeakunkelompok,
                'namaakunkelompok' => $item->namaakunkelompok,
                'kodeakunjenis' => $item->kodeakunjenis,
                'namaakunjenis' => ($item->namaakunjenis == '' ? "_NA_" . $item->kodesatker : $item->namaakunjenis),
                'kodeakunobjek' => $item->kodeakunobjek,
                'namaakunobjek' => $item->namaakunobjek,
                'kodeakunrincian' => $item->kodeakunrincian,
                'namaakunrincian' => $item->namaakunrincian,
                'kodeakunsub' => $item->kodeakunsub,
                'namaakunsub' => $item->namaakunsub,
                'nilaianggaran' => $item->nilaianggaran
            ];
            array_push($dt, $b);
        }

        return ['output' => $dt, 'sotk' => $sotk];
    }

    public function getApbd($tahun, $apbdindex, $coa)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
        $con = DB::connection('pgsql');
        $a = $con->table('v_koderekapbd')
            ->select(
                'apbdindex',
                'kodesatker',
                'kodepemda',
                'namapemda',
                'tahunanggaran',
                'tglpengiriman',
                'jeniscoa',
                'kodedata',
                'namaaplikasi',
                'pengembangaplikasi',
                DB::raw('TRIM(kodeurusanprogram) as kodeurusanprogram'),
                DB::raw('TRIM(namaurusanprogram) as namaurusanprogram'),
                'kodeurusanpelaksana',
                'namaurusanpelaksana',
                'kodeskpd',
                'namaskpd',
                'kodeprogram',
                'namaprogram',
                'kodekegiatan',
                'namakegiatan',
                'kodefungsi',
                'namafungsi',
                DB::raw('TRIM(kodeakunutama) as kodeakunutama'),
                DB::raw('TRIM(namaakunutama) as namaakunutama'),
                DB::raw('TRIM(kodeakunkelompok) as kodeakunkelompok'),
                DB::raw('TRIM(namaakunkelompok) as namaakunkelompok'),
                DB::raw('TRIM(kodeakunjenis) as kodeakunjenis'),
                DB::raw('TRIM(namaakunjenis) as namaakunjenis'),
                'kodeakunobjek',
                'namaakunobjek',
                'kodeakunrincian',
                'namaakunrincian',
                'kodeakunsub',
                'namaakunsub',
                'nilaianggaran'
            )->where([
                'jeniscoa' => $coa,
                'apbdindex' => $apbdindex,
                'tahunanggaran' => $tahun
            ])
            ->get();

        $dt = [];
        $sotk = $this->cekSotk($tahun);
        foreach ($a as $item) {
            $b = [
                'apbdindex' => $item->apbdindex,
                'kodesatker' => $item->kodesatker,
                'kodepemda' => $item->kodepemda,
                'namapemda' => $item->namapemda,
                'tahunanggaran' => $item->tahunanggaran,
                'tglpengiriman' => $item->tglpengiriman,
                'jeniscoa' => $item->jeniscoa,
                'kodedata' => $item->kodedata,
                'namaaplikasi' => $item->namaaplikasi,
                'pengembangaplikasi' => $item->pengembangaplikasi,
                'kodeurusanprogram' => $item->kodeurusanprogram,
                'namaurusanprogram' => $item->namaurusanprogram,
                'kodeurusanpelaksana' => $item->kodeurusanpelaksana,
                'namaurusanpelaksana' => $item->namaurusanpelaksana,
                'kodeskpd' => $item->kodeskpd,
                'namaskpd' => $item->namaskpd,
                'kodeprogram' => $item->kodeprogram,
                'namaprogram' => $item->namaprogram,
                'kodekegiatan' => $item->kodekegiatan,
                'namakegiatan' => $item->namakegiatan,
                'kodefungsi' => $item->kodefungsi,
                'namafungsi' => $item->namafungsi,
                'kodeakunutama' => $item->kodeakunutama,
                'namaakunutama' => $item->namaakunutama,
                'kodeakunkelompok' => $item->kodeakunkelompok,
                'namaakunkelompok' => $item->namaakunkelompok,
                'kodeakunjenis' => $item->kodeakunjenis,
                'namaakunjenis' => ($item->namaakunjenis == '' ? "_NA_" . $item->kodesatker : $item->namaakunjenis),
                'kodeakunobjek' => $item->kodeakunobjek,
                'namaakunobjek' => $item->namaakunobjek,
                'kodeakunrincian' => $item->kodeakunrincian,
                'namaakunrincian' => $item->namaakunrincian,
                'kodeakunsub' => $item->kodeakunsub,
                'namaakunsub' => $item->namaakunsub,
                'nilaianggaran' => $item->nilaianggaran
            ];
            array_push($dt, $b);
        }

        return ['output' => $dt, 'sotk' => $sotk];
    }

    public function cekSotk($tahun)
    {
        switch ($tahun) {
            case($tahun < 2017):
                $sotk = '2016';
                break;
            case($tahun > 2016):
                $sotk = '2017';
                break;
        }
        return $sotk;
    }

    public function formatTable($data)
    {
        foreach ($data as $item) {
            $output[] = [
                'apbdindex' => ($item['apbdindex'] == '' ? 'NULL' : $item['apbdindex']),
                'kodesatker' => ($item['kodesatker'] == '' ? 'NULL' : $item['kodesatker']),
                'kodepemda' => ($item['kodepemda'] == '' ? 'NULL' : $item['kodepemda']),
                'namapemda' => ($item['namapemda'] == '' ? 'NULL' : $item['namapemda']),
                'tahunanggaran' => ($item['tahunanggaran'] == '' ? 'NULL' : $item['tahunanggaran']),
                'bulan' => ($item['bulan'] == '' ? 'NULL' : $item['bulan']),
                'jeniscoa' => ($item['jeniscoa'] == '' ? 'NULL' : $item['jeniscoa']),
                'tglpengiriman' => ($item['tglpengiriman'] == '' ? 'NULL' : $item['tglpengiriman']),
                'namaaplikasi' => ($item['namaaplikasi'] == '' ? 'NULL' : $item['namaaplikasi']),
                'pengembangaplikasi' => ($item['pengembangaplikasi'] == '' ? 'NULL' : $item['pengembangaplikasi']),
                'kegiatanindex' => 'NULL',
                'kodeurusanprogram' => ($item['kodeurusanprogram'] == '' ? 'NULL' : $item['kodeurusanprogram']),
                'namaurusanprogram' => ($item['namaurusanprogram'] == '' ? 'NULL' : $item['namaurusanprogram']),
                'kodeurusanpelaksana' => ($item['kodeurusanpelaksana'] == '' ? 'NULL' : $item['kodeurusanpelaksana']),
                'namaurusanpelaksana' => ($item['namaurusanpelaksana'] == '' ? 'NULL' : $item['namaurusanpelaksana']),
                'kodeskpd' => ($item['kodeskpd'] == '' ? 'NULL' : $item['kodeskpd']),
                'namaskpd' => ($item['namaskpd'] == '' ? 'NULL' : $item['namaskpd']),
                'kodeprogram' => ($item['kodeprogram'] == '' ? 'NULL' : $item['kodeprogram']),
                'namaprogram' => ($item['namaprogram'] == '' ? 'NULL' : $item['namaprogram']),
                'kodekegiatan' => ($item['kodekegiatan'] == '' ? 'NULL' : $item['kodekegiatan']),
                'namakegiatan' => ($item['namakegiatan'] == '' ? 'NULL' : $item['namakegiatan']),
                'kodefungsi' => ($item['kodefungsi'] == '' ? 'NULL' : $item['kodefungsi']),
                'namafungsi' => ($item['namafungsi'] == '' ? 'NULL' : $item['namafungsi']),
                'kodeakunutama' => ($item['kodeakunutama'] == '' ? 'NULL' : $item['kodeakunutama']),
                'namaakunutama' => ($item['namaakunutama'] == '' ? 'NULL' : $item['namaakunutama']),
                'kodeakunkelompok' => ($item['kodeakunkelompok'] == '' ? 'NULL' : $item['kodeakunkelompok']),
                'namaakunkelompok' => ($item['namaakunkelompok'] == '' ? 'NULL' : $item['namaakunkelompok']),
                'kodeakunjenis' => ($item['kodeakunjenis'] == '' ? 'NULL' : $item['kodeakunjenis']),
                'namaakunjenis' => ($item['namaakunjenis'] == '' ? 'NULL' : $item['namaakunjenis']),
                'kodeakunobjek' => ($item['kodeakunobjek'] == '' ? 'NULL' : $item['kodeakunobjek']),
                'namaakunobjek' => ($item['namaakunobjek'] == '' ? 'NULL' : $item['namaakunobjek']),
                'kodeakunrincian' => ($item['kodeakunrincian'] == '' ? 'NULL' : $item['kodeakunrincian']),
                'namaakunrincian' => ($item['namaakunrincian'] == '' ? 'NULL' : $item['namaakunrincian']),
                'kodeakunsub' => ($item['kodeakunsub'] == '' ? 'NULL' : $item['kodeakunsub']),
                'namaakunsub' => ($item['namaakunsub'] == '' ? 'NULL' : $item['namaakunsub']),
                'kodeurusanprogram_map' => ($item['kodeurusanprogram_map'] == '' ? 'NULL' : $item['kodeurusanprogram_map']),
                'namaurusanprogram_map' => ($item['namaurusanprogram_map'] == '' ? 'NULL' : $item['namaurusanprogram_map']),
                'kodefungsi_map' => ($item['kodefungsi_map'] == '' ? 'NULL' : $item['kodefungsi_map']),
                'namafungsi_map' => ($item['namafungsi_map'] == '' ? 'NULL' : $item['namafungsi_map']),
                'kodeakunutama_map' => ($item['kodeakunutama_map'] == '' ? 'NULL' : $item['kodeakunutama_map']),
                'namaakunutama_map' => ($item['namaakunutama_map'] == '' ? 'NULL' : $item['namaakunutama_map']),
                'kodeakunkelompok_map' => ($item['kodeakunkelompok_map'] == '' ? 'NULL' : $item['kodeakunkelompok_map']),
                'namaakunkelompok_map' => ($item['namaakunkelompok_map'] == '' ? 'NULL' : $item['namaakunkelompok_map']),
                'kodeakunjenis_map' => ($item['kodeakunjenis_map'] == '' ? 'NULL' : $item['kodeakunjenis_map']),
                'namaakunjenis_map' => ($item['namaakunjenis_map'] == '' ? 'NULL' : $item['namaakunjenis_map']),
                'nilaianggaran' => $item['nilaianggaran'],
                'temp_jenis_id' => ($item['temp_jenis_id'] == '' ? 'NULL' : $item['temp_jenis_id']),
                'temp_urusan_id' => ($item['temp_urusan_id'] == '' ? 'NULL' : $item['temp_urusan_id']),

            ];
        }

        return $output;
    }

    public function hapusDataMappingLra($kodesatker, $tahun, $bulan)
    {

    }
}