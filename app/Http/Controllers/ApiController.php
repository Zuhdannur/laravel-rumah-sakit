<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPasien() {
        $query = \App\Pasien::all();

        $return = [];
        foreach ($query as $item) {
            $return[] = [
                "id" => $item->id_pasien,
                "text" => $item->nama_pasien,
                "value" => $item->id_pasien
            ];
        }

        $json = [
            "results" => $return
        ];
        return response()->json($json);
    }

    public function getDokter() {
        $query = \App\Dokter::all();

        $return = [];
        foreach ($query as $item) {
            $return[] = [
                "id" => $item->id_dokter,
                "text" => $item->nama_dokter,
                "value" => $item->id_dokter
            ];
        }

        $json = [
            "results" => $return
        ];
        return response()->json($json);
    }

    public function getPoli() {
        $query = \App\Poli::all();

        $return = [];
        foreach ($query as $item) {
            $return[] = [
                "id" => $item->id_poli,
                "text" => $item->nama_poli,
                "value" => $item->id_poli
            ];
        }

        $json = [
            "results" => $return
        ];
        return response()->json($json);
    }

    public function generateCode(Request $request) {
        $input = $request->all();

        $date = \Carbon\Carbon::createFromFormat('d/m/Y',$request->tanggal)->format('Y-m-d');
        $find = \App\Rujukan::whereDate('tanggal',$date)->orderBy('id_rujukan','desc')->first();

        if(!empty($find)) {
            $splitString = explode('Y',$find->nomor_rujukan);

            $generatedCode = str_replace('-','',$date).'Y'.((int)$splitString[1] + 1);

            return response()->json([
                "code" => $generatedCode
            ]);
        }

        return response()->json([
            "code" => str_replace('-','',$date).'Y1'
        ]);

    }

    public function getRekamMedis(Request $request) {
        $query = \App\RekamMedis::where('id_pasien',$request->search)->get();

        $return = [];
        foreach ($query as $item) {
            $return[] = [
                "id" => $item->id_rekam_medis,
                "text" => $item->nomor_pendaftaran,
                "value" => $item->id_rekam_medis
            ];
        }

        $json = [
            "results" => $return
        ];
        return response()->json($json);
    }

}
