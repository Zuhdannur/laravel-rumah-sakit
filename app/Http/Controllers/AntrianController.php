<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AntrianController extends Controller
{
    public function index() {
        return view('pages.antrian.antrian_view');
    }

    public function create() {
        return view('pages.antrian.antrian_form');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'id_poli' => 'required',
            'id_pasien' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error' ,$validator->errors());
        }
        $input = $request->all();

        $kodefikasi = \App\Poli::find($input['id_poli']);

        $input['nomor_antrian'] = $this->getPosition($kodefikasi);

        $insert = \App\Antrian::create($input);
        return redirect()->route('antrian.show',['antrian' => $insert->id_antrian]);
    }

    public function getPosition($kodefikasi) {
        $allData = \App\Antrian::where('id_poli',$kodefikasi->id_poli)->orderBy('nomor_antrian','desc')->first();
        if(empty($allData)) {
            return ((int)1);
        }
        return ((int)$allData->nomor_antrian + 1);

    }

    public function show($id) {
        $antrian = \App\Antrian::find($id);
        $data['nomor'] = $antrian->kodefikasi->kodefikasi.'-'.$antrian->nomor_antrian;
        return view('pages.antrian.antrian_view_detail')->with($data);
    }

    public function callAntrian($id) {

        $antrian = \App\Antrian::where([['status',0],['id_poli',$id]])->orderBy('nomor_antrian')->first();
        if(empty($antrian)) {
            return redirect()->back()->with('error' ,'Tidak Ada Antrian');
        }
        $antrian->update([
            "status" => 1
        ]);
        return redirect()->back()->with('success','Memanggil '.$antrian->kodefikasi->kodefikasi.'-'.$antrian->nomor_antrian);
    }

    public function simpan(Request $request) {
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

        return redirect('/antrian')->with('success','Data Berhasil Diinput');
    }
}
