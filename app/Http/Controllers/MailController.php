<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helper\email;
use Mail;
use App\Mail\DataMasuk;

class MailController extends Controller
{
    protected $email;

    public function __construct(email $email)
    {
        $this->email = $email;
    }

    public function kirim($apbdindex)
    {
        $a = 0;

        $body = $this->email->sendMail($apbdindex);
        while ($a <= 6) {
            $a = Mail::to()->queue(new DataMasuk($body));
            $a++;
        }

        return 'oke';
    }
}
