<?php
/**
 * Created by PhpStorm.
 * User: Plue
 * Date: 4/2/2017
 * Time: 1:36 AM
 */

namespace App\Http\Helper;

use Illuminate\Support\Facades\DB;

class pemda
{
    public function getKontakPIC($param, $value)
    {
        switch ($param) {
            case $param == 'provinsi':
                $column = 'a.kodeprovinsi';
                break;
            case $param == 'pemda':
                $column = 'a.kodesatker';
                break;
        }

        $data = DB::table('ref_pemda as a')
            ->select('a.kodesatker as kodesatker',
                'a.kodeprovinsi',
                'a.kodepemda',
                'a.ursingkat',
                'c.id as id_pic',
                'c.name as nama_pic',
                'c.unit as unit_pic',
                'd.id as id_kontak',
                'd.nama as nama_kontak',
                'd.email1 as email1_kontak',
                'd.email2 as email2_kontak',
                'd.hp1 as hp1_kontak',
                'd.hp2 as hp2_kontak',
                'd.unit as unit_kontak')
            ->leftjoin('ant_user_pemda as b', 'a.kodesatker', '=', 'b.kodesatker')
            ->leftjoin('users as c', 'b.user_id', '=', 'c.id')
            ->leftjoin('kontak_pemda as d', 'a.kodesatker', '=', 'd.kodesatker')
            ->where($column, '=', $value)
            ->get();

        foreach ($data as $item) {


            $output[$item->kodesatker]['daerah'] = [
                'kodesatker' => $item->kodesatker,
                'kodeprovinsi' => $item->kodeprovinsi,
                'kodepemda' => $item->kodepemda,
                'namapemda' => $item->ursingkat,
            ];

            $output[$item->kodesatker]['pic'][$item->id_pic] = [
                'id_pic' => $item->id_pic,
                'nama_pic' => $item->nama_pic,
                'unit' => $item->unit_pic,
            ];

            $output[$item->kodesatker]['kontak'][] = [
                'id_kontak' => $item->id_kontak,
                'nama_kontak' => $item->nama_kontak
            ];
        }

        return $output;
    }

    public function getAllKontakPIC($kodesatker)
    {
        $data = DB::table('ref_pemda as a')
            ->select('a.kodesatker as kodesatker',
                'a.kodeprovinsi',
                'a.kodepemda',
                'a.ursingkat',
                'c.id as id_pic',
                'c.name as nama_pic',
                'c.unit as unit_pic',
                'd.id as id_kontak',
                'd.nama as nama_kontak',
                'd.email1 as email1_kontak',
                'd.email2 as email2_kontak',
                'd.hp1 as hp1_kontak',
                'd.hp2 as hp2_kontak',
                'd.unit as unit_kontak')
            ->leftjoin('ant_user_pemda as b', 'a.kodesatker', '=', 'b.kodesatker')
            ->leftjoin('users as c', 'b.user_id', '=', 'c.id')
            ->leftjoin('kontak_pemda as d', 'a.kodesatker', '=', 'd.kodesatker')
            ->get();
        return $data;
    }


    public function getDDPemda()
    {
        $seprov = $this->getDDSeprovinsi();
        $pemda = $this->getDDSatker();

        return array_merge_recursive($pemda, $seprov);
    }

    public function getDDSeprovinsi()
    {
        $data = DB::table('ref_pemda')
            ->select(DB::raw('CONCAT(kodeprovinsi,"._") as value, concat("se-",ursingkat) as text'))
            ->where('kodepemda', '=', '00')
            ->get();

        return collect($data)->toArray();
    }

    public function getDDSatker()
    {
        $data = DB::table('ref_pemda')
            ->select(DB::raw('CONCAT(kodeprovinsi,".",kodepemda) as value, ursingkat as text'))
            ->get();

        return collect($data)->toArray();
    }
}