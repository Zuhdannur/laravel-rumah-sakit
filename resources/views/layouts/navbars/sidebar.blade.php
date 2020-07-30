<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="http://www.creative-tim.com" class="simple-text logo-mini">
    </a>
    <a href="http://www.creative-tim.com" class="simple-text logo-normal">
      {{ __('Sistem Antrian') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="@if ($activePage == 'home') active @endif">
        <a href="{{ url('/') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li>
        <a data-toggle="collapse" href="#laravelExamples">
            <i class="now-ui-icons design_bullet-list-67"></i>
          <p>
            {{ __("Master Data") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if($activePage == 'pasien' OR $activePage == 'dokter' or $activePage == 'poli') show @endif" id="laravelExamples">
          <ul class="nav">
              <li class="@if ($activePage == 'pasien') active @endif">
                  <a href="{{ route('pasien.index') }}">
                      <i class="now-ui-icons users_single-02"></i>
                      <p>{{ __('Data Pasien') }}</p>
                  </a>
              </li>
              <li class="@if ($activePage == 'dokter') active @endif">
                  <a href="{{ route('dokter.index') }}">
                      <i class="now-ui-icons users_single-02"></i>
                      <p>{{ __('Data Dokter') }}</p>
                  </a>
              </li>
              <li class="@if ($activePage == '') active @endif">
                  <a href="{{ route('dokter.index') }}">
                      <i class="now-ui-icons users_single-02"></i>
                      <p>{{ __('Pengguna') }}</p>
                  </a>
              </li>
              <li class="@if ($activePage == '') active @endif">
                  <a href="{{ route('dokter.index') }}">
                      <i class="now-ui-icons users_single-02"></i>
                      <p>{{ __('Tenaga Medis') }}</p>
                  </a>
              </li>
              <li class="@if ($activePage == 'poli') active @endif">
                  <a href="{{ route('poli.index') }}">
                      <i class="now-ui-icons users_single-02"></i>
                      <p>{{ __('Poli') }}</p>
                  </a>
              </li>
            <li class="@if ($activePage == 'profile') active @endif">
{{--              <a href="{{ route('profile.edit') }}">--}}
{{--                <i class="now-ui-icons users_single-02"></i>--}}
{{--                <p> {{ __("User Profile") }} </p>--}}
{{--              </a>--}}
            </li>
            <li class="@if ($activePage == 'users') active @endif">
{{--              <a href="{{ route('user.index') }}">--}}
{{--                <i class="now-ui-icons design_bullet-list-67"></i>--}}
{{--                <p> {{ __("User Management") }} </p>--}}
{{--              </a>--}}
            </li>
          </ul>
        </div>
      <li class="@if ($activePage == 'icons') active @endif">
{{--        <a href="{{ route('page.index','icons') }}">--}}
{{--          <i class="now-ui-icons education_atom"></i>--}}
{{--          <p>{{ __('Icons') }}</p>--}}
{{--        </a>--}}
      </li>
      <li class = "@if ($activePage == 'maps') active @endif">
{{--        <a href="{{ route('page.index','maps') }}">--}}
{{--          <i class="now-ui-icons location_map-big"></i>--}}
{{--          <p>{{ __('Maps') }}</p>--}}
{{--        </a>--}}
      </li>
      <li class = " @if ($activePage == 'notifications') active @endif">
{{--        <a href="{{ route('page.index','notifications') }}">--}}
{{--          <i class="now-ui-icons ui-1_bell-53"></i>--}}
{{--          <p>{{ __('Notifications') }}</p>--}}
{{--        </a>--}}
      </li>
      <li class = " @if ($activePage == 'table') active @endif">
{{--        <a href="{{ route('page.index','table') }}">--}}
{{--          <i class="now-ui-icons design_bullet-list-67"></i>--}}
{{--          <p>{{ __('Table List') }}</p>--}}
{{--        </a>--}}
      </li>
      <li class = "@if ($activePage == 'typography') active @endif">
{{--        <a href="{{ route('page.index','typography') }}">--}}
{{--          <i class="now-ui-icons text_caps-small"></i>--}}
{{--          <p>{{ __('Typography') }}</p>--}}
{{--        </a>--}}
      </li>
      <li class = "">
{{--        <a href="{{ route('page.index','upgrade') }}" class="bg-info">--}}
{{--          <i class="now-ui-icons arrows-1_cloud-download-93"></i>--}}
{{--          <p>{{ __('Upgrade to PRO') }}</p>--}}
{{--        </a>--}}
      </li>
        <li>
            <a data-toggle="collapse" href="#ruangBerobat">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p>
                    {{ __("Ruang Berobat") }}
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse @if($activePage == 'rekam-medis') show @endif" id="ruangBerobat">
                <ul class="nav">
                    <li class="@if ($activePage == 'rekam-medis') active @endif">
                        <a href="{{ route('rekam-medis.index') }}">
                            <i class="now-ui-icons files_paper"></i>
                            <p>{{ __('Data Rekam Medis') }}</p>
                        </a>
                    </li>
                    <li class="@if ($activePage == '') active @endif">
                        <a href="{{ route('pasien.index') }}">
                            <i class="now-ui-icons health_ambulance"></i>
                            <p>{{ __('Rujukan') }}</p>
                        </a>
                    </li>
                    <li class="@if ($activePage == '') active @endif">
                        <a href="{{ route('pasien.index') }}">
                            <i class="now-ui-icons design_image"></i>
                            <p>{{ __('Kartu Berobat') }}</p>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
  </div>
</div>

