@extends('layouts.app', [
    'namePage' => 'Daftar Rujukan Pasien',
    'class' => 'sidebar-mini',
    'activePage' => 'rujukan',
  ])
@push('extra-css')
    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery-spinner.min.css">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Input Data Rujukan</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('rujukan.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nomor Rujukan</label>
                            <input type="text" class="form-control" name="nomor_rujukan"  required readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Rujukan</label>
                            <input type="text" class="form-control" placeholder="Tanggal" name="tanggal" required id="tanggal">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pasien</label>
                            <select class="form-control" name="id_pasien" id="list_pasien">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Poli</label>
                            <select class="form-control" name="id_poli" id="list_poli">
                                @foreach($poli as $item)
                                    <option value="{{ $item->id_poli}}">{{ $item->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Rekam Medis</label>
                            <select class="form-control" name="id_rekam_medis" id="list_rekam_medis">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Asal RS/Puskesmas</label>
                            <input class="form-control" id="exampleFormControlTextarea1" rows="2" name="asal">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tujuan Rs/Puskesmas</label>
                            <input class="form-control" id="exampleFormControlTextarea1" rows="2" name="ke">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Alamat Tujuan Rujukan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="alamat_tujuan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Keterangan Rujukan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="keterangan"></textarea>
                        </div>
                        <div class="row justify-content-end p-lg-3 p-sm-3">
                            <button rel="tooltip" class="btn btn-info btn-sm pt-sm-3 pt-lg-2" type="submit">
                                Tambah Rujukan
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
    <script src="{{ asset('assets') }}/js/plugins/jquery-spinner.min.js"></script>
    <script>
        $(document).ready(function () {
            var spinner = new jQuerySpinner({
                parentId:'main',
                duration: 1000
            })

            $('#tanggal').datetimepicker({
                format :'d/m/Y',
                closeOnDateSelect:true,
                closeOnTimeSelect:true,
                closeOnWithoutClick:true,
                onSelectDate:function () {
                    spinner.show()

                    $.ajax({
                        url: '{{ url('/generateCode')  }}',
                        method: 'POST',
                        data: {
                            tanggal: $("#tanggal").val(),
                            _token: '{{ csrf_token() }}'
                        },
                        success:function (data) {
                            spinner.hide();
                            $("[name=nomor_rujukan]").val(data.code)
                        }
                    })
                },

                {{--onChangeDateTime:function (dp,$input) {--}}
                {{--   --}}


                {{--}--}}
            });

            $("#list_pasien").select2({
                ajax: {
                    url: '{{ url('/getPasien')  }}',
                    data: function (params) {

                    }
                }
            })

            $("#list_poli").select2({
                ajax: {
                    url: '{{ url('/getPoli') }}',
                    data: function (params) {

                    }
                }
            })

            $("#list_rekam_medis").select2({
                ajax: {
                    url: '{{ url('/getRekamMedis') }}',
                    data: function (params) {
                        var query = {
                            search: $("#list_pasien").val(),
                            type: 'public'
                        }
                        return query;
                    }
                }
            })

        })
    </script>
@endpush
