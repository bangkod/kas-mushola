<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kas;

class HomeController extends Controller
{
    public function home()
    {
    	$keluar = Kas::where('jenis', 'keluar')->where('status', 1)->sum('keluar');
    	$masuk = Kas::where('jenis', 'masuk')->where('status', 1)->sum('jumlah');
    	$saldo = $masuk-$keluar;
    	return view('home',[
    		'keluar' => $keluar,
    		'masuk' => $masuk,
    		'saldo' => $saldo
    	]);
    }
}
