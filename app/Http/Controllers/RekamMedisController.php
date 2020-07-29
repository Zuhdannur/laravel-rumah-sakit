<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RekamMedisController extends Controller
{
    public function index() {
        return view('pages.rekam-medis.rekam_medis_view');
    }

    public function create() {
        $data['pasien'] = \App\Pasien::all();
        $data['dokter'] = \App\Dokter::all();
        $data['number'] = $this->generateNomorPendaftaran();

        return view('pages.rekam-medis.rekam_medis_form')->with($data);
    }

    public function generateNomorPendaftaran() {
        $query = \App\RekamMedis::orderBy('id_rekam_medis','DESC')->first();
        if(empty($query)) {
            return "0001";
        } else {
            $nomor_pendaftaran = (int)$query->nomor_pendaftaran;
            if(strlen((string)$nomor_pendaftaran) == 1) {
                $return = "000";
            } else if(strlen((string)$nomor_pendaftaran) == 2) {
                $return = "00";
            } else if(strlen((string)$nomor_pendaftaran) == 3) {
                $return = "0";
            } else {
                $return = "";
            }

            return $return.($nomor_pendaftaran + 1);
        }
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            'nomor_pendaftaran' => 'required',
            'id_pasien' => 'required',
            'id_dokter' => 'required',
            'tgl_periksa' => 'required',
            'anemnesis' => 'required',
            'periksa_fisik' => 'required',
            'plan' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('error' ,$validator->errors());
        }

        $input = $request->all();
        $input['tgl_periksa'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i',$input['tgl_periksa'])->format('Y-m-d H:i:s');
        $input['id_petugas'] = Auth::user()->id;

        $create = \App\RekamMedis::create($input);
        return redirect('/rekam-medis')->with('success','Data Berhasil di input');
    }

    public function getData(Request $request) {
        $input = $request->all();
        $query = new \App\RekamMedis;

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

        $query = $query->skip($start)->take($length)->orderBy('id_rekam_medis');
        $i = $start + 1;
        foreach ($query->get() as $row) {
            $d = [];
            $d[] = $row->nomor_pendaftaran;
            $d[] = $row->dokter->nama_dokter;
            $d[] = $row->anemnesis;
            $d[] = $row->pemeriksaan_fisik;
            $d[] = $row->diagnosis;
            $d[] = $row->plan;
            $d[] = $row->petugas->name;
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
