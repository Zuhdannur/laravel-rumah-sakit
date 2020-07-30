<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoliController extends Controller
{
    public function index() {
        return view('pages.poli.poli_view');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            'nama_poli' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->errors());
        }
        $input = $request->all();

        $create = \App\Poli::create($input);
        return redirect('/poli')->with('success','Data Berhasil Diinput');
    }

    public function create() {
        return view('pages.poli.poli_form');
    }

    public function getData(Request $request) {
        $input = $request->all();
        $query = new \App\Poli;

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
                $q->orWhere('nama_poli','like','%'.$search['value'].'%');
            });
        }

        $data['recordsFiltered'] = $query->count();

        $query = $query->skip($start)->take($length)->orderBy('id_poli');
        $i = $start + 1;
        foreach ($query->get() as $row) {
            $d = [];
            $d[] = $i++;
            $d[] = $row->nama_poli;
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
