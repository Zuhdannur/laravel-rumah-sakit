@extends('layouts.app', [
    'namePage' => 'Daftar Obat',
    'class' => 'sidebar-mini',
    'activePage' => 'obat',
  ])

@push('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/datatables.css">
@endpush

@section('content')


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Daftar Obat</h4>
                        <a href="{{ route('obat.create') }}" rel="tooltip" class="btn btn-info btn-sm pt-sm-3 pt-lg-2">
                            <i class="now-ui-icons users_single-02"></i>
                            Tambah Obat
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-end">
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="table_id">
                                <thead>
                                <th>
                                    Kode Obat
                                </th>
                                <th>
                                    Nama Obat
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
                    url: '{{ url('/obat/data/getData') }}',
                    type: 'GET',
                    global: false,
                    data:function (e) {
                        return e;
                    }
                }
            })

            $('body').on('click','.btnDelete',function() {
                var form = $(this).parent();

                form.submit();
            })
        })
    </script>
@endpush
