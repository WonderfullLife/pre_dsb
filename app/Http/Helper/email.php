<?php
/**
 * Created by PhpStorm.
 * User: Plue
 * Date: 03/04/2017
 * Time: 16.24
 */

namespace App\Http\Helper;

use DB;

class email
{

    public function sendMail($apbdindex)
    {
        return $this->getLraLvl1($apbdindex);
    }

    public function getLraLvl1($apbdindex)
    {
        $data = DB::connection('pgsql')->table('v_realisasikoderekapbd')
            ->select(DB::raw('namapemda, tahunanggaran, bulan, tglpengiriman, kodeakunutama, namaakunutama, SUM(nilaianggaran) as nilai'))
            ->where('apbdindex', '=', $apbdindex)
            ->groupBy('namapemda', 'tahunanggaran', 'bulan', 'tglpengiriman', 'kodeakunutama', 'namaakunutama')
            ->get();
        setlocale(LC_MONETARY, 'id_ID');

        foreach ($data as $item) {
            $output['profil'] = [
                'nama_pemda' => $item->namapemda,
                'tahun_anggaran' => $item->tahunanggaran,
                'bulan' => $item->bulan,
                'tanggal' => $item->tglpengiriman
            ];
            $output['akun'][] = [
                'kode_akun' => $item->kodeakunutama,
                'nama_akun' => ($item->namaakunutama == '' ? 'kosong' : $item->namaakunutama),
                'nilai' => money_format('%.2n', (double)$item->nilai)
            ];
        }

        return $output;
    }
}