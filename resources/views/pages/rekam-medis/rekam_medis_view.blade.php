@extends('layouts.app', [
    'namePage' => 'Rekam Medis',
    'class' => 'sidebar-mini',
    'activePage' => 'rekam-medis',
  ])

@push('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/datatables.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Daftar Rekam Medis</h4>
                    <a href="{{ route('rekam-medis.create') }}" rel="tooltip" class="btn btn-info btn-sm pt-sm-3 pt-lg-2">
                        <i class="now-ui-icons users_single-02"></i>
                        Tambah Rekam Medis
                    </a>
                </div>
                <div class="card-body">
                    <div class="row justify-content-end">
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="table_id">
                            <thead>
                            <th>
                                Nomor Pendaftaran
                            </th>
                            <th>
                                Tanggal Pemeriksaan
                            </th>
                            <th>
                                Ruang
                            </th>
                            <th>
                                Anamnesis
                            </th>
                            <th>
                                Pemeriksaan Fisik
                            </th>
                            <th>
                                Plan
                            </th>
                            <th>
                                Petugas
                            </th>
                            <th>
                                Aksi
                            </th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets') }}/js/datatables.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable({
                "ordering": false,
                deferRender: true,
                serverSide: true,
                processing: true,
                orderMulti: true,
                stateSave: true,
                ajax: {
                    url: '{{ url('/rekam-medis/data/getData') }}',
                    type: 'GET',
                    global: false,
                    data:function (e) {
                        return e;
                    }
                }
            })
        })
    </script>
@endpush
