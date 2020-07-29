<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    public function index() {
        return view('pages.dokter.dokter_view');
    }

    public function create() {
        return view('pages.dokter.dokter_form');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'nama_dokter' => 'required',
            'nip' => 'required',
            'nomor_ktp' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'spesialis' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error' ,$validator->errors());
        }

        $input = $request->all();
        $input['tgl_lahir'] = \Carbon\Carbon::createFromFormat('d/m/Y',$input['tgl_lahir'])->format('Y-m-d');

        $create = \App\Dokter::create($input);
        return redirect('/dokter')->with('success','Data Berhasil di input');
    }

    public function getData(Request $request) {
        $input = $request->all();
        $query = new \App\Dokter;

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
                $q->orWhere('nama_dokter','like','%'.$search['value'].'%');
            });
        }

        $data['recordsFiltered'] = $query->count();

        $query = $query->skip($start)->take($length)->orderBy('id_dokter');
        $i = $start + 1;
        foreach ($query->get() as $row) {
            $d = [];
            $d[] = $row->nama_dokter;
            $d[] = $row->tgl_lahir->format('d/M/Y');
            $d[] = $row->spesialis;
            $d[] = $row->nomor_telp;
            $button = '<button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                 </button>';
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
}
