<?php

namespace App\Http\Controllers;

use App\Http\Helper\log;
use Illuminate\Http\Request;
use App\Http\Helper\user;
use App\Http\Helper\pemda;
use Cache;
use App\Http\Helper\referensi;

class HomeController extends Controller
{
    protected $user;
    protected $pemda;
    protected $log;
    protected $referensi;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(user $user, pemda $pemda, log $log, referensi $referensi)
    {
        //$this->middleware('auth');
        $this->user = $user;
        $this->pemda = $pemda;
        $this->log = $log;
        $this->referensi = $referensi;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function cekIndex($jenis, $tahun)
    {
        return $this->log->cekIndex($jenis, $tahun);
    }

    public function getBelumMapping($kodesatker, $tahun)
    {
        $jenis = ['jenis', 'urusan'];
        $temp['jenis'] = $this->referensi->getHomeTempJenis($tahun);
        $temp['urusan'] = $this->referensi->getHomeTempUrusan($tahun);
        $temp['referensi'] = $this->getPemdaTemp($kodesatker, $tahun);
        $a = $this->referensi->getSatkerTemp($jenis, $kodesatker, $tahun);
        return $a;
    }

    public function getPemdaTemp($kodesatker, $tahun)
    {
        $data['jenis'] = $this->referensi->getTempMap('jenis', $kodesatker, $tahun);
        $data['urusan'] = $this->referensi->getTempMap('urusan', $kodesatker, $tahun);
        return $data;
    }
}
