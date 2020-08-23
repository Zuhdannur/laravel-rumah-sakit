<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    public function index() {
        return view('pages.obat.obat_view');
    }

    public function getData(Request $request) {
        $input = $request->all();
        $query = new \App\Obat;

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
                $q->orWhere('nama_obat','like','%'.$search['value'].'%');
                $q->orWhere('kd_obat','like','%'.$search['value'].'%');
            });
        }

        $data['recordsFiltered'] = $query->count();

        $query = $query->skip($start)->take($length)->orderBy('id_obat');
        $i = $start + 1;
        foreach ($query->get() as $row) {
            $d = [];
            $d[] = $row->kd_obat;
            $d[] = $row->nama_obat;
            $button = '
            <form method="post" action='. route('obat.destroy',$row->id_obat).'>
            <input name="_method" value="delete" hidden >
            <input name="_token" value='. csrf_token() .' hidden>
            <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon btnDelete">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                 </button></form>';
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
            'kd_obat' => 'required',
            'nama_obat' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error' ,$validator->errors());
        }

        $input = $request->all();
        $insert = \App\Obat::create($input);

        return redirect('/obat')->with('success','Data Berhasil di input');
    }

    public function create() {

        $lastInserted = \App\Obat::orderBy('id_obat','desc')->first();


        if(!empty($lastInserted)) {
            $number = preg_replace('/[^0-9]/', '', $lastInserted->kd_obat);
            $number = (int)$number + 1;
            $lenght = strlen($number);
            if($lenght == 1) {
                $number = '000'.$number;
            } else if($lenght == 2) {
                $number = '00'.$number;
            } else if($lenght == 3) {
                $number = '0'.$number;
            } else if($lenght == 4) {
                $number = $number;
            }
        } else {
            $number = '0001';
        }

        $data['kode'] = 'K'.$number;
        


        return view('pages.obat.obat_form')->with($data);
    }

    public function destroy($id) {
        $delete = \App\Obat::find($id)->delete();
        return redirect()->back()->with('success','Data Berhasil Di hapus');
    }

}
