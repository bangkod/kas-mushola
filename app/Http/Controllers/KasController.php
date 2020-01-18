<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kas;

class KasController extends Controller
{
    public function kas_keluar()
    {
        $kas = Kas::where('jenis', 'keluar')->where('status', 1)->orderBy('created_at', 'desc')->get();
        $jumlah = Kas::where('jenis', 'keluar')->where('status', 1)->sum('keluar');
        return view('kas.keluar', ['kas' => $kas, 'jumlah' => $jumlah]);
    }
    public function kas_masuk()
    {
        $kas = Kas::where('jenis', 'masuk')->where('status', 1)->orderBy('created_at', 'desc')->get();
        $jumlah = Kas::where('jenis', 'masuk')->where('status', 1)->sum('jumlah');
        return view('kas.masuk', ['kas' => $kas, 'jumlah' => $jumlah]);
    }
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $kas = new Kas;
        $kas->kode = $request->kode;
        $kas->keterangan = $request->keterangan;
        $kas->tgl = $request->tanggal;
        if ($request->jenis == 'masuk') {
            $kas->jumlah = $request->jumlah;
            $kas->jenis = 'masuk';
            $kas->keluar = 0;
        }else{
            $kas->jumlah = 0;
            $kas->jenis = 'keluar';
            $kas->keluar = $request->jumlah;
        }
        if($kas->save())
        {
            return response()->json(['success' => '1'], 200);
        }
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy(Request $request)
    {
        $kas = Kas::where('kode', $request->kode);
        if ($kas->update(['status' => 0])) {
            return response()->json(['success' => '1'], 200);
        }
    }
}
