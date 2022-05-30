<div id="opacity-overlay"></div>
<div id="header">
    @if ($withBackground)
    <div id="header-bg"></div>
    @endif
    <nav id="nav">
        <ul id="menu">
        @foreach ($navRoutes as $routeName)
            <li><a {!! Route::currentRouteName() == $routeName ? 'class="current" ' : '' !!}href="{{ route($routeName) }}">{{ $friendlyNameResolver($routeName) }}</a></li>
        @endforeach
        </ul>
    </nav>
    <a id="mobile-menu-open" href="javascript:void(0)">
        <img width="30" height="30" src="{{ asset('img/menu.svg') }}">
    </a>
    <h1>{{ $friendlyNameResolver(Route::currentRouteName()) }}</h1>
    @if (session('message'))
    <p class="flash-message {{ session('status') }}">{{ session('message') }}</p>
    @endif
</div>
