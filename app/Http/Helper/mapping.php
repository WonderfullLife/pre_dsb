<?php
/**
 * Created by PhpStorm.
 * User: Plue
 * Date: 03/04/2017
 * Time: 11.24
 */

namespace App\Http\Helper;

use App\Http\Helper\format;
use DB;

class mapping
{
    protected $format;

    public function __construct(format $format)
    {
        $this->format = $format;
    }

    public function proses($referensi, $data, $tahun)
    {
        ini_set('max_execution_time', 0);
        $output = [];
        $sotk = $data['sotk'];
        $errorJenId = [];
        $errorUrId = [];
        $referensiTemp = $referensi['referensiSementara'];
        $referensi = $referensi['referensiUtama'];

        foreach ($data['output'] as $item) {
            $kodesatker = $item['kodesatker'];
            $keyJenis = $this->format->bersih($item['kodeakunutama'] . $item['kodeakunkelompok'] . $item['kodeakunjenis'] . $item['namaakunjenis']);
            $keyUrusan = $this->format->bersih($item['kodeurusanprogram'] . $item['namaurusanprogram']);
            if (!array_key_exists($keyJenis, $referensi['jenis'])) {
                if (!array_key_exists($keyJenis, $referensiTemp['jenis'])) {
                    $id = DB::table('temp_jenis')->insertGetId([
                        'kodeakunutama' => $item['kodeakunutama'],
                        'kodeakunkelompok' => $item['kodeakunkelompok'],
                        'kodeakunjenis' => $item['kodeakunjenis'],
                        'namaakunjenis' => $item['namaakunjenis'],
                        'tahun' => $tahun,
                        'status_map' => 0
                    ]);
                    $referensiTemp['jenis'][$keyJenis] = ['id' => $id];
                    $item['temp_jenis_id'] = $id;
                    $errorJenId[] = $id;

                } else {
                    $item['temp_jenis_id'] = $referensiTemp['jenis'][$keyJenis]['id'];
                    $errorJenId[] = $referensiTemp['jenis'][$keyJenis]['id'];
                }
                $item['kodeakunutama_map'] = null;
                $item['namaakunutama_map'] = null;
                $item['kodeakunkelompok_map'] = null;
                $item['namaakunkelompok_map'] = null;
                $item['kodeakunjenis_map'] = null;
                $item['namaakunjenis_map'] = null;
            } else {
                $item['kodeakunutama_map'] = $referensi['jenis'][$keyJenis]['kd_akun'];
                $item['namaakunutama_map'] = $referensi['jenis'][$keyJenis]['nm_akun'];
                $item['kodeakunkelompok_map'] = $referensi['jenis'][$keyJenis]['kd_kelompok'];
                $item['namaakunkelompok_map'] = $referensi['jenis'][$keyJenis]['nm_kelompok'];
                $item['kodeakunjenis_map'] = $referensi['jenis'][$keyJenis]['kd_jenis'];
                $item['namaakunjenis_map'] = $referensi['jenis'][$keyJenis]['nm_jenis'];
                $item['temp_jenis_id'] = null;
            }

            if (!array_key_exists($keyUrusan, $referensi['urusan'])) {
                if (!array_key_exists($keyUrusan, $referensiTemp['urusan'])) {
                    $id = DB::table('temp_urusan')->insertGetId([
                        'kodeurusanprogram' => $item['kodeurusanprogram'],
                        'namaurusanprogram' => $item['namaurusanprogram'],
                        'kd_urusan' => null,
                        'tahun' => $sotk,
                        'status_map' => 0
                    ]);
                    $referensiTemp['urusan'][$keyUrusan] = ['id' => $id];
                    $item['temp_urusan_id'] = $id;
                    $errorUrId[] = $id;

                } else {
                    $item['temp_urusan_id'] = $referensiTemp['urusan'][$keyUrusan]['id'];
                    $errorUrId[] = $referensiTemp['urusan'][$keyUrusan]['id'];
                }

                $item['kodeurusanprogram_map'] = null;
                $item['namaurusanprogram_map'] = null;
                $item['kodefungsi_map'] = null;
                $item['namafungsi_map'] = null;
            } else {
                $item['kodeurusanprogram_map'] = $referensi['urusan'][$keyUrusan]['kd_urusan'];
                $item['namaurusanprogram_map'] = $referensi['urusan'][$keyUrusan]['nm_urusan'];
                $item['kodefungsi_map'] = $referensi['urusan'][$keyUrusan]['kd_fungsi'];
                $item['namafungsi_map'] = $referensi['urusan'][$keyUrusan]['nm_fungsi'];
                $item['temp_urusan_id'] = null;
            }
            array_push($output, $item);

        }
        return [
            'data' => $output,
            'kodesatker' => $kodesatker,
            'error' => [
                'jenis' => array_values(array_unique($errorJenId)),
                'urusan' => array_values(array_unique($errorUrId)),
            ]
        ];
    }

    public function createCsv($output, $apbdindex)
    {
        ini_set('memory_limit', '-1');
        $file = fopen('c:\wamp\www\beta\public\\' . $apbdindex . '.csv', 'w');
        $key = array_keys($output[0]);
        //fputcsv($file,$key);
        foreach ($output as $item) {
            fputcsv($file, $item, '|');
        }
        //file_put_contents('c:\wamp\www\beta\public\tes.csv',$kalimat);
        fclose($file);
        return 'oke';
    }

    public function cekHasilMapping($jenis, $apbdindex)
    {
        $tabel = $jenis . '_hasil_mapping';
        $a = DB::table($tabel)->select('apbdindex')->where('apbdindex', '=', $apbdindex)->limit(1)->get();
        return $a->isEmpty();
    }

    public function deleteHasilMapping($jenis, $apbdindex)
    {
        $tabel = $jenis . '_hasil_mapping';
        DB::table($tabel)->where('apbdindex', '=', $apbdindex)->delete();
    }

    public function updateStatusNotif($jenis, $apbdindex)
    {
        $tabel = 'log_index_' . $jenis . '_sementara';
        DB::table($tabel)->where('indexcore', '=', $apbdindex)->update(['status_notif' => 1]);
    }
}