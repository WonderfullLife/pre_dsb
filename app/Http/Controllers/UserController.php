<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helper\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;

    public function __construct(user $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        $data['users'] = $this->user->getAllUser();
        $data['role'] = $this->user->getRoleAll();
        $data['wilayah'] = $this->user->getScopeDaerah();
        //return $data;
        return view('pengaturan.pengguna.index', ['data' => $data]);
    }

    public function getId($userid)
    {
        $data = $this->user->getUser($userid);
        return collect($data[0])->toArray();
    }

    public function getEdit($userid)
    {
        $data = $this->user->getUserDetail($userid);
        return $data;
    }

    public function getUserWilayah($userid)
    {
        $data = $this->user->getDaerahPIC($userid);
        return $data;
    }

    public function postTambahUser(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:5|unique:users,name',
            'unit' => 'required|numeric|max:2',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required'
        ]);
        DB::table('users')
            ->insert([
                'name' => $request->nama,
                'unit_id' => $request->unit,
                'email' => $request->email,
                'role_id' => 1,
                'scope_id' => 0,
                'password' => Hash::make($request->email)
            ]);

        return redirect()->back();
    }

    public function postEditUser(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:5',
            'unit' => 'required',
            'email' => 'required',
            'id' => 'required'
        ]);
        DB::table('users')
            ->where(['id' => $request->id])
            ->update([
                'name' => $request->nama,
                'unit_id' => 1,
                'email' => $request->email,
            ]);

        return 'ok';
    }

    public function postEditUserAkses(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'groupAkses' => 'required'
        ]);
        DB::table('users')
            ->where(['id' => $request->id])
            ->update([
                'role_id' => $request->groupAkses,
            ]);

        return 'ok';
    }

    public function postResetPass(Request $request)
    {
        $email = $this->user->getUser($request->id);
        if ($request->group1 == 1) {
            DB::table('users')
                ->where(['id' => $request->id])
                ->update([
                    'password' => HASH::make($email[0]->email)
                ]);
        }
        return 'ok';
    }
}
