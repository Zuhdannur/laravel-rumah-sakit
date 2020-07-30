<div class="wrapper wrapper-full-page ">
    @include('layouts.navbars.navs.guest')
    <div class="full-page register-page section-image" data-image="{{ asset('assets') . "/img/bg14.jpg" }}">
        @yield('content')
        @include('layouts.footer')
    </div>
</div>
