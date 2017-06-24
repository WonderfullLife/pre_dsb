<?php
/**
 * Created by PhpStorm.
 * User: Plue
 * Date: 4/2/2017
 * Time: 12:47 AM
 */

namespace App\Http\Helper;

use Illuminate\Support\Facades\DB;

class user
{
    public function getDaerahPIC($userid)
    {
        $data = DB::table('ant_scope_pemda as a')
            ->select('d.nama as grup', 'b.kodesatker', 'b.kodeprovinsi', 'b.kodepemda', 'b.ursingkat')
            ->join('ref_pemda as b', 'a.kodesatker', '=', 'b.kodesatker')
            ->join('scope_daerah as d', 'a.scope_id', '=', 'd.id')
            ->leftjoin('users as c', 'a.scope_id', '=', 'c.id')
            ->where('c.id', '=', $userid)
            ->get();
        return ($data->isEmpty() ? $data[0] = null : $data);
    }

    public function getRoleDetail($userid)
    {
        $data = DB::table('users as a')
            ->select('a.id as id_user', 'a.name as nama_user', 'a.email as email_user', 'a.unit', 'b.id as id_role', 'b.nama as nama_role')
            ->join('ref_role as b', 'a.role_id', '=', 'b.id')
            ->join('')
            ->where('a.id', '=', $userid)
            ->get();
        return ($data->isEmpty() ? $data[0] = null : $data);
    }

    public function getUser($userid)
    {
        $data = DB::table('users as a')
            ->select('a.id', 'a.name as nama', 'a.email', 'd.nama as unit', 'a.status', 'b.keterangan', 'c.nama as wilayah')
            ->leftjoin('ref_role as b', 'a.role_id', '=', 'b.id')
            ->leftjoin('scope_daerah as c', 'a.scope_id', '=', 'c.id')
            ->leftjoin('unit as d', 'a.unit_id', '=', 'd.id')
            ->where('a.id', '=', $userid)
            ->get();
        return ($data->isEmpty() ? $data[0] = null : $data);
    }

    public function getUserDetail($userid)
    {
        $data['user'] = $this->getUser($userid)[0];
        $data['daerah'] = $this->getDaerahPIC($userid);
        return $data;
    }

    public function getScopeKodesatker($userid)
    {
        return collect($this->getDaerahPIC($userid))->pluck('kodesatker')->toArray();
    }

    public function cekScopeKodesatker($userid, array $kodesatker)
    {
        $daerah = $this->getScopeKodesatker($userid);
        $valid = array_intersect($daerah, $kodesatker);
        return (count($valid) != 0 ? $valid : false);
    }

    public function deleteUser($userid)
    {
        DB::table('users as a')
            ->where('id', '=', $userid)
            ->delete();
    }

    public function getAllUser()
    {
        $data = DB::table('users as a')
            ->select('a.id', 'a.name as nama', 'a.email', 'd.nama as unit', 'a.status', 'b.keterangan', 'c.nama as wilayah')
            ->leftjoin('ref_role as b', 'a.role_id', '=', 'b.id')
            ->leftjoin('scope_daerah as c', 'a.scope_id', '=', 'c.id')
            ->leftjoin('unit as d', 'a.unit_id', '=', 'd.id')
            ->get();
        return $data;
    }

    public function getRoleAll()
    {
        $data = DB::table('ref_role')
            ->select('id', 'keterangan')
            ->get();
        return $data;
    }

    public function getScopeDaerah()
    {
        $data = DB::table('scope_daerah')
            ->select('id', 'nama')
            ->get();
        return $data;
    }
}