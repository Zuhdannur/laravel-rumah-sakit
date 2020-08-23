<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApotikController extends Controller
{
    public function index() {
        return view('pages.apotik.apotik_view');
    }

    public function getData(Request $request) {
        $input = $request->all();
        $query = new \App\Apotik;

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
                $q->orWhereHas('pasien',function($query)  use ($search) {
                    $query->where('nama_pasien','like','%'.$search['value'].'%');
                });
                $q->orWhereHas('jenis_obat',function($query)  use ($search) {
                    $query->where('nama_obat','like','%'.$search['value'].'%');
                });
            });
        }

        $data['recordsFiltered'] = $query->count();

        $query = $query->skip($start)->take($length)->orderBy('id_apotik');
        $i = $start + 1;
        foreach ($query->get() as $row) {
            $d = [];
            $d[] = $row->pasien->nama_pasien;
            $d[] = $row->jenis_obat->nama_obat;
            $d[] = $row->nama_obat;
            $d[] = $this->uang(@$row->harga);
            $d[] = $row->stock;
            $button = '
            <form method="post" action='. route('apotik.destroy',$row->id_apotik).'>
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
            'id_pasien' => 'required',
            'id_obat' => 'required',
            'nama_obat' => 'required',
            'stock' => 'required',
            'harga' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error' ,$validator->errors());
        }

        $input = $request->all();
        $insert = \App\Apotik::create($input);

        return redirect('/apotik')->with('success','Data Berhasil di input');
    }

    public function create() {

        $data['pasien'] = \App\Pasien::all();
        $data['jenis_obat'] = \App\Obat::all();
        

        return view('pages.apotik.apotik_form')->with($data);
    }

    public function destroy($id) {
        $delete = \App\Apotik::find($id)->delete();
        return redirect()->back()->with('success','Data Berhasil Di hapus');
    }

    function uang($uang)
    {
        $uang = number_format($uang, 0, ',', '.');
        return $uang;
    }
}
