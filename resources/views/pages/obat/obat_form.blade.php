@extends('layouts.app', [
    'namePage' => 'Daftar Obat',
    'class' => 'sidebar-mini',
    'activePage' => 'obat',
  ])
@push('extra-css')
    <link rel="stylesheet" href="{{ asset('assets') }}/css/ui.css">
@endpush
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input Data Obat</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('obat.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Kode Obat</label>
                            <input type="text" class="form-control" placeholder="kode" name="kd_obat" value="{{ $kode }}" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Obat</label>
                                <input type="text" class="form-control" placeholder="Nama Obat" name="nama_obat" required>
                            </div>
                    
                            <div class="row justify-content-end p-lg-3 p-sm-3">
                                <button rel="tooltip" class="btn btn-info btn-sm pt-sm-3 pt-lg-2" type="submit">
                                    Tambah Obat
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
    <script>
        $(document).ready(function () {
            
        })
    </script>
@endpush
