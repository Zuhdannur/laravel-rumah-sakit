@extends('layouts.app', [
    'namePage' => 'Daftar Kartu Berobat',
    'class' => 'sidebar-mini',
    'activePage' => 'kartu-berobat',
  ])

@push('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/datatables.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery-spinner.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Daftar Antrian Berobat</h4>
                </div>
                <div class="card-body">
                    <div class="row justify-content-end">
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="table_id">
                            <thead>
                            <th>
                                No Antrian
                            </th>
                            <th>
                                Nama Pasien
                            </th>
                            <th>
                                Poli
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
    <script src="{{ asset('assets') }}/js/plugins/jquery-spinner.min.js"></script>
    <script>
        $(document).ready(function () {
            var spinner = new jQuerySpinner({
                parentId:'main',
                duration: 1000
            })

            var tbl = $('#table_id').DataTable({
                "ordering": false,
                deferRender: true,
                serverSide: true,
                processing: true,
                orderMulti: true,
                stateSave: true,
                ajax: {
                    url: '{{ url('/kartu-berobat/data/getData') }}',
                    type: 'GET',
                    global: false,
                    data:function (e) {
                        return e;
                    }
                }
            })

            $('body').on('click','.btnAcc',function () {
                spinner.show();

                var unique = $(this).val()
                $.ajax({
                    url: '{{ url('/rujukan/data/acc')  }}',
                    method: 'POST',
                    data: {
                        id: unique,
                        _token: '{{ csrf_token() }}'
                    },
                    success:function (data) {
                        spinner.hide();
                        tbl.ajax.reload();
                    }
                })
            })
        })
    </script>
@endpush
