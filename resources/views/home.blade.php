@extends('layouts.app', [
    'namePage' => 'Dashboard',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
{{--  <div class="panel-header panel-header-lg">--}}
{{--    <canvas id="bigDashboardChart"></canvas>--}}
{{--  </div>--}}
    <div class="row">
        @foreach($data as $item)
      <div class="col-lg-4">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Antrian</h5>
            <h4 class="card-title">Poli {{ $item['judul'] }}</h4>
          </div>
          <div class="card-body">
            <h5 class="card-title">No : {{ $item['nomor'] }}</h5>
              <form action="{{ url('/call-antrian') .'/'. $item['id_poli'] }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-primary btn-round btn-lg">{{__('Panggil Antrian Selanjutnya')}}</button>
              </form>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>
        @endforeach
        <div class="col-lg-8 col-md-6">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Waktu</h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title" id="date-part"></h5>
                    <h5 class="card-title" id="time-part"></h5>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/js/moment.min.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
        var interval = setInterval(function() {
            var momentNow = moment().locale('id');
            $('#date-part').html(momentNow.format('YYYY MMMM DD') + ' '
                + momentNow.format('dddd')
                    .substring(0,3).toUpperCase());
            $('#time-part').html(momentNow.format('hh:mm:ss A'));
        }, 100);

    });
  </script>
@endpush
