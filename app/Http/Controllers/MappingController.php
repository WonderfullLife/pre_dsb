<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helper\sikd;
use App\Http\Helper\referensi;
use App\Http\Helper\mapping;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MappingController extends Controller
{
    protected $sikd;
    protected $referensi;
    protected $mapping;
    protected $coa = 1;
    private $banyakData = 500;

    public function __construct(sikd $sikd, referensi $referensi, mapping $mapping)
    {
        $this->sikd = $sikd;
        $this->referensi = $referensi;
        $this->mapping = $mapping;
    }

    public function prosedurMapping($jenis, $tahun, $apbdindex)
    {
        //return $this->referensi->getReferensiTemp($tahun);
        $error = 0;
        $hasilMapping['data'] = '';
        $w1 = Carbon::now()->format('Y-m-d H:i:s');
        $data = $this->ambilDataDaerah($jenis, $tahun, $apbdindex);
        $w2 = Carbon::now()->format('Y-m-d H:i:s');
        if (!count($data['output']) == 0) {
            $referensi = $this->ambilDataReferensi($tahun);
            $w3 = Carbon::now()->format('Y-m-d H:i:s');
            $hasilMapping = $this->mulaiProsesMapping($referensi, $data, $tahun);
            $w4 = Carbon::now()->format('Y-m-d H:i:s');
            $error = $this->mulaiProsesPostMapping($hasilMapping, $tahun, $apbdindex, $jenis);
            $w5 = Carbon::now()->format('Y-m-d H:i:s');
            $ts = $this->simpanHasilMapping($jenis, $hasilMapping['data'], $error);
            $w6 = $ts['w6'];
            $w7 = $ts['w7'];
            $this->mapping->updateStatusNotif($jenis, $apbdindex);
            $w8 = Carbon::now()->format('Y-m-d H:i:s');
        }

        return [
            'w1' => $w1,
            'w2' => $w2,
            'w3' => $w3,
            'w4' => $w4,
            'w5' => $w5,
            'w6' => $w6,
            'w7' => $w7,
            'w8' => $w8,
            'error' => $error,
            'jml' => count($data['output']),
        ];
    }

    public function ambilDataDaerah($jenis, $tahun, $apbdindex)
    {
        $data = null;
        switch ($jenis) {
            case($jenis == 'apbd'):
                $data = $this->sikd->getApbd($tahun, $apbdindex, $this->coa);
                break;
            case($jenis == 'lra'):
                $data = $this->sikd->getLra($tahun, $apbdindex, $this->coa);
                break;
        }

        return $data;
    }

    public function ambilDataReferensi($tahun)
    {
        return [
            'referensiSementara' => $this->referensi->getReferensiTemp($tahun),
            'referensiUtama' => $this->referensi->getReferensiMap($tahun)
        ];
    }

    public function mulaiProsesMapping($referensi, $data, $tahun)
    {
        return $this->mapping->proses($referensi, $data, $tahun);
    }

    public function mulaiProsesPostMapping($hasilMapping, $tahun, $apbdindex, $jenis)
    {
        $errror = $this->cekErrorBaru($hasilMapping, $tahun);
        $this->deleteDuplikasiHasilMapping($jenis, $apbdindex);
        return $errror;
    }

    public function deleteDuplikasiHasilMapping($jenis, $apbdindex)
    {
        $a = $this->mapping->cekHasilMapping($jenis, $apbdindex);
        if ($a) {
            $this->mapping->deleteHasilMapping($jenis, $apbdindex);
        }
    }

    public function simpanHasilMapping($jenis, $data, $error)
    {
        $w7 = 0;
        $this->simpanData($jenis, $data);
        $w6 = Carbon::now()->format('Y-m-d H:i:s');
        if ($error != null) {
            $this->referensi->SimpanTempMap($error);
            $w7 = Carbon::now()->format('Y-m-d H:i:s');
        }
        return ['w6' => $w6, 'w7' => $w7];
    }

    public function simpanData($jenis, $data)
    {
        $table = $jenis . '_hasil_mapping';
        $data = array_chunk($data, $this->banyakData);
        foreach ($data as $item) {
            DB::table($table)->insert($item);
        }
    }

    public function cekErrorBaru($hasilMapping, $tahun)
    {
        $output = null;
        $data = $hasilMapping['error'];
        $kodesatker = $hasilMapping['kodesatker'];
        foreach ($data as $key => $item) {
            $ref = $this->referensi->getTempMap($key, $kodesatker, $tahun);
            $a = array_diff($item, $ref);
            foreach ($a as $b) {
                $output[$key][] = [
                    'kodesatker' => $kodesatker,
                    'temp_' . $key . '_id' => $b,
                    'tahun' => $tahun
                ];
            }
        }

        return $output;
    }

    private function _import_csv($apbdindex)
    {
        $csv = 'c:\wamp\www\beta\public\\' . $apbdindex . '.csv';
        $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE lra_hasil_mapping FIELDS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' LINES TERMINATED BY '\\n' ", addslashes($csv));
        return DB::connection('mysql')->getpdo()->exec($query);
    }

    public function ambilTempLimit($tahun, $posisi, $jumlah)
    {
        return [
            'temp_jenis' => $this->referensi->getTempJenisLimit($tahun, $posisi, $jumlah),
            'temp_urusan' => $this->referensi->getTempUrusanLimit($tahun, $posisi, $jumlah)
        ];
    }

    public function getHomeMapingJenis($tahun = 2017)
    {
        $data = $this->referensi->getTempJenis($tahun);
        //return $data;
        return view('maping.maping_jenis', ['data' => $data]);
    }

    public function getDataJenis($tahun, $posisi, $jumlah)
    {
        return $this->referensi->getTempJenisLimit($tahun, $posisi, $jumlah);
    }

    public function getRefJenis($tahun)
    {
        return $this->referensi->getRefJenisTahun($tahun);
    }

    public function getTempJenisSatker($id)
    {
        return $this->referensi->getSatkerTempJenis($id);
    }
}
