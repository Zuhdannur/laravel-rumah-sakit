<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    public function index() {
        $data['data'] = \App\Pasien::paginate(5);
        return view('pages.pasien.pasien_view')->with($data);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            'nama_pasien' => 'required',
            'nama_KK' => 'required',
            'nomor_ktp' => 'required',
            'tgl_lahir' => 'required',
            'nomor_kis' => 'required',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'status_peserta' => 'required',
            'faskes' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error',$validator->errors());
        }
        $input = $request->all();

        $input['tgl_lahir'] = \Carbon\Carbon::createFromFormat('d/m/Y',$input['tgl_lahir']);
        $create = \App\Pasien::create($input);

        $update = \App\Pasien::find($create->id_pasien);
        $update->update([
            "nomor_pasien" => "P".$create->id_pasien
        ]);

        return redirect('/pasien')->with('success','Data Berhasil Diinput');
    }

    public function create() {
        return view('pages.pasien.pasien_form');
    }

    public function getData(Request $request) {
        $input = $request->all();
        $query = new \App\Pasien;

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
               $q->orWhere('nama_pasien','like','%'.$search['value'].'%');
            });
        }

        $data['recordsFiltered'] = $query->count();

        $query = $query->skip($start)->take($length)->orderBy('id_pasien');
        $i = $start + 1;
        foreach ($query->get() as $row) {
            $d = [];
            $d[] = $row->nama_pasien;
            $d[] = $row->tgl_lahir->format('d/M/Y');
            if($row->status == 0) {
                $button = '<button type="button" rel="tooltip" class="btn btn-danger btn-sm">
                        Non Aktif
                </button>';
            } else {
                $button = '<button type="button" rel="tooltip" class="btn btn-success btn-sm">
                        Aktif
                </button>';
            }
            $d[] = $button;
            $d[] = $row->status_peserta;

            $action = '<button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>';

            $d[] = $action;
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
