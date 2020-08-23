@extends('layouts.app', [
    'namePage' => 'Daftar Pengguna',
    'class' => 'sidebar-mini',
    'activePage' => 'user',
  ])
@push('extra-css')
    <link rel="stylesheet" href="{{ asset('assets') }}/css/ui.css">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Input Data Pengguna</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pengguna.store') }}" id="form">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Pengguna</label>
                            <input type="text" class="form-control" placeholder="Nama Pengguna" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="email" class="form-control money" placeholder="Email Pengguna" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="row justify-content-end p-lg-3 p-sm-3">
                            <button rel="tooltip" class="btn btn-info btn-sm pt-sm-3 pt-lg-2" type="submit">
                                Tambah Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets')  }}/js/ui.js"></script>
    <script src="{{ asset('assets')}}/js/plugins/jquery.mask.js"></script>
    <script>
        $(document).ready(function () {

        })
    </script>
@endpush
