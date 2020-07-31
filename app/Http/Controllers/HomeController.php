<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $query = \App\Poli::all();

        foreach ($query as $item) {
            $antrian = \App\Antrian::where([['status',1],['id_poli', $item->id_poli]])->orderBy('nomor_antrian','asc')->first();
            if(!empty($antrian)) {
                $data[] = [
                    "id_poli" => $item->id_poli,
                    "judul" => $item->nama_poli,
                    "nomor" => $item->kodefikasi.'-'.$antrian->nomor_antrian
                ];
            } else {
                $data[] = [
                    "id_poli" => $item->id_poli,
                    "judul" => $item->nama_poli,
                    "nomor" => "Tidak Ada Antrian"
                ];
            }
        }
        return view('home')->with('data',$data);
    }
}
