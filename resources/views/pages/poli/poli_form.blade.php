@extends('layouts.app', [
    'namePage' => 'Poli',
    'class' => 'sidebar-mini',
    'activePage' => 'poli',
  ])
@push('extra-css')
    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/select2.min.css">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Input Data Poli</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('poli.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Poli</label>
                            <input type="text" class="form-control" name="nama_poli" required>
                        </div>
                        <div class="row justify-content-end p-lg-3 p-sm-3">
                            <button rel="tooltip" class="btn btn-info btn-sm pt-sm-3 pt-lg-2" type="submit">
                                Tambah Poli
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets')  }}/js/jquery.datetimepicker.full.min.js"></script>
    <script src="{{ asset('assets') }}/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.datepicker').datetimepicker({
                timepicker: true,
                format :'d/m/Y H:i'
            });

            $("#list_pasien").select2({
                ajax: {
                    url: '{{ url('/getPasien')  }}',
                    data: function (params) {

                    }
                }
            })

            $("#list_dokter").select2({
                ajax: {
                    url: '{{ url('/getDokter') }}',
                    data: function (params) {

                    }
                }
            })
        })
    </script>
@endpush
