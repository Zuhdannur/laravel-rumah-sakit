<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RujukanController extends Controller
{
    public function index() {
        return view('pages.rujukan.rujukan_view');
    }

    public function getData(Request $request) {
        $input = $request->all();
        $query = new \App\Rujukan;

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
                $q->orWhere('asal','like','%'.$search['value'].'%');
                $q->orWhere('ke','like','%'.$search['value'].'%');
                $q->orWhere('alamat_tujuan','like','%'.$search['value'].'%');
                $q->orWhereHas('pasien',function($query)  use ($search) {
                    $query->where('nama_pasien','like','%'.$search['value'].'%');
                });

            });
        }

        $data['recordsFiltered'] = $query->count();

        $query = $query->skip($start)->take($length)->orderBy('id_rujukan');
        $i = $start + 1;
        foreach ($query->get() as $row) {
            $d = [];
            $d[] = $row->nomor_rujukan;
            $d[] = $row->pasien->nama_pasien;
            $d[] = $row->asal;
            $d[] = $row->ke;

            if($row->status == 0) {
                $hidden = "";
                $status = '<button type="button" rel="tooltip" class="btn btn-danger btn-sm">
                        Belum Dirujuk
                </button>';
            } else {
                $hidden = "hidden";
                $status = '<button type="button" rel="tooltip" class="btn btn-success btn-sm">
                        Sudah Di Rujuk
                </button>';
            }
            $d[] = $status;

            $button = '
            <div class="row">

            <form method="post" action='. route('rujukan.destroy',$row->id_rujukan).'>
            <input name="_method" value="delete" hidden >
            <input name="_token" value='. csrf_token() .' hidden>
            <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon btnDelete">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                 </button></form>&nbsp;
                 <button class="btn btn-sm btn-icon"><i class="now-ui-icons files_paper"></i></button>&nbsp;
                 <button value="'. $row->id_rujukan .'" class="btn btn-sm btn-icon btn-success btnAcc" '. $hidden .'><i class="now-ui-icons ui-1_check"></i></button>
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

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'id_pasien' => 'required',
            'id_poli' => 'required',
            'nomor_rujukan' => 'required',
            'asal' => 'required',
            'ke' => 'required',
            'alamat_tujuan' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error' ,$validator->errors());
        }

        $input = $request->all();
        $input['tanggal'] = \Carbon\Carbon::createFromFormat('d/m/Y',$input['tanggal'])->format('Y-m-d');
        $insert = \App\Rujukan::create($input);

        return redirect('/rujukan')->with('success','Data Berhasil di input');
    }

    public function create() {

        $data['pasien'] = \App\Pasien::all();
        $data['poli'] = \App\Poli::all();
        $data['jenis_obat'] = \App\Obat::all();


        return view('pages.rujukan.rujukan_form')->with($data);
    }

    public function destroy($id) {
        $delete = \App\Rujukan::find($id)->delete();
        return redirect()->back()->with('success','Data Berhasil Di hapus');
    }

    public function acc(Request $request) {
        $acc = \App\Rujukan::find($request->id)->update([
            "status" => 1
        ]);
        return response()->json([
            "message" => "success"
        ]);
    }
}
