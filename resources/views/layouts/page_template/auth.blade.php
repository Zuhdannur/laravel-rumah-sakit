
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@include('layouts.navbars.sidebar')
<div class="main-panel" id="main">
    @include('layouts.navbars.navs.auth')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        @include('alerts.success')
        @yield('content')
    </div>
    @include('layouts.footer')
</div>
