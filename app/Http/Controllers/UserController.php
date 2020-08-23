<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return view('pages.pengguna.pengguna_view');
    }

    public function store(Request $request) {
        $input = $request->all();
        $create = \App\User::create($input);
        if($create) {
            return redirect('/pengguna')->with('success','Data Berhasil Di Input');
        } else {
            return redirect()->back()->with('error','Data Gagal DiInput');
        }
    }

    public function getData(\Illuminate\Http\Request $request) {
        $input = $request->all();
        $query = new \App\User;

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
                $q->orWhere('name','like','%'.$search['value'].'%');
                $q->orWhere('email','like','%'.$search['value'].'%');
            });
        }

        $data['recordsFiltered'] = $query->count();

        $query = $query->skip($start)->take($length)->orderBy('id');
        $i = $start + 1;
        foreach ($query->get() as $row) {
            $d = [];
            $d[] = $i++;
            $d[] = $row->name;
            $d[] = $row->email;
            $button = '
            <form method="post" action='. route('pengguna.destroy',$row->id).'>
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

    public function destroy($id) {
        $delete = \App\User::find($id)->delete();
        return redirect()->back()->with('success','Data Berhasil Di hapus');
    }

    public function create() {
        return view('pages.pengguna.pengguna_form');
    }
}
