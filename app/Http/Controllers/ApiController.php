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
}
