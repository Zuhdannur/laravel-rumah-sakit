<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class KartuBerobatController extends Controller
{
    public function index() {
        return view('pages.kartu-berobat.kartu_berobat_view');
    }

    public function getData(Request $request) {
        $input = $request->all();
        $query = new \App\Antrian;

        $length = (int)@$input['length'];
        $start = (int)@$input['start'];
        $search = @$input['search'];
        $order = @$input['order'];

        $data = array();

        $count = $query->count();

        $data['recordsFiltered'] = $count;
        $data['recordsTotal'] = $count;

        if (!empty($search) AND !empty($search['value'])) {
            $query = $query->where(function ($q) use ($search) {
                $q->orWhere('nomor_antrian','like','%'.$search['value'].'%');
                $q->orWhereHas('pasien',function($query)  use ($search) {
                    $query->where('nama_pasien','like','%'.$search['value'].'%');
                });
                $q->orWhereHas('kodefikasi',function($query)  use ($search) {
                    $query->where('nama_poli','like','%'.$search['value'].'%');
                });

            });
        }

        $data['recordsFiltered'] = $query->count();

        $query = $query->skip($start)->take($length)->orderBy('id_antrian');
        $i = $start + 1;
        foreach ($query->get() as $row) {
            $d = [];
            $d[] = $row->nomor_antrian;
            $d[] = $row->pasien->nama_pasien;
            $d[] = $row->kodefikasi->nama_poli;


            $button = '
            <div class="row">
                 <form method="post" action='. url('/kartu-berobat/data/cetak') .'>
                    <input name="id" value='. $row->id_antrian .' hidden>
                    <input name="_token" value='. csrf_token() .' hidden>
                    <button class="btn btn-sm" type="submit"><i class="now-ui-icons files_paper"></i>&nbsp;Cetak Kartu</button>&nbsp;
                 </form>
</div>
                 ';

            $d[] = $button;
            $data['data'][] = $d;
        }

        if (empty($data['data'])) {
            $data['recordsTotal'] = $count;
            $data['recordsFiltered'] = 0;
            $data['aaData'] = [];
        }


        return response()->json($data);
    }

    public function cetak(Request $request) {
        $data['query'] = \App\Antrian::find($request->id);

        $pdf = PDF::loadView('report.kartu_berobat_report',$data);
        return $pdf->stream('rujukan.pdf');
    }
}
