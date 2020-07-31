@extends('layouts.app', [
    'namePage' => 'Nomor Antrian',
    'activePage' => 'nomor_antrian',
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
                            <h4 class="card-title">{{ __('Mohon Jangan Hilang') }}</h4>
                            <div class="social">
                                <h5 class="card-description">  {{ __('Berikut Nomor Antrian Anda') }}</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">  {{ $nomor }}</h5>
                        </div>
                    </div>
                </div>
                <a href="{{ route('antrian.index') }}" class="btn btn-primary btn-round btn-lg">{{__('Kembali')}}</a>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
        });
    </script>
@endpush
