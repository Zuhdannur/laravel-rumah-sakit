@extends('layouts.app', [
    'namePage' => 'Antrian Page',
    'activePage' => 'antrian',
    'backgroundImage' => asset('assets') . "/img/bg16.jpg",
])

@push('extra-css')
    <link rel="stylesheet" href="{{ asset('assets') }}/css/select2.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Isi Data Dibawah') }}</h4>
                            <div class="social">
                                <h5 class="card-description">  {{ __('Untuk Mendapatkan Nomor Antrian   ') }}</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register.store') }}">
                            @csrf
                            <!--Begin input name -->
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Nama Pasien</label>
                                    <select class="form-control" name="id_pasien" id="list_pasien">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Nama Poli</label>
                                    <select class="form-control" name="id_poli" id="list_poli">
                                    </select>
                                </div>
                                <!--Begin input email -->
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-primary btn-round btn-lg">{{__('Ambil Nomor Antrian')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#list_pasien").select2({
                ajax: {
                    url: '{{ url('/getPasien')  }}',
                    data: function (params) {

                    }
                }
            })

            $("#list_poli").select2({
                ajax: {
                    url: '{{ url('/getPoli')  }}',
                    data: function (params) {

                    }
                }
            })
        });
    </script>
@endpush
