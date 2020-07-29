@extends('layouts.app', [
    'namePage' => 'Daftar Rekam Medis',
    'class' => 'sidebar-mini',
    'activePage' => 'rekam-medis',
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
                    <h4 class="card-title">Input Data Rekam Medis</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('rekam-medis.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nomor Pendaftaran</label>
                            <input type="text" class="form-control" name="nomor_pendaftaran" value="{{ $number }}" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pasien</label>
                            <select class="form-control" name="id_pasien" id="list_pasien">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Dokter</label>
                            <select class="form-control" name="id_dokter" id="list_dokter">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal</label>
                            <input type="text" class="form-control datepicker" placeholder="Tanggal" name="tgl_periksa" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Anemnesis</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="anemnesis"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Pemeriksaan Fisik</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="periksa_fisik"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Diagnosis</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="diagnosis"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Plan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="plan"></textarea>
                        </div>
                        <div class="row justify-content-end p-lg-3 p-sm-3">
                            <button rel="tooltip" class="btn btn-info btn-sm pt-sm-3 pt-lg-2" type="submit">
                                Tambah Rekam Medis
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
