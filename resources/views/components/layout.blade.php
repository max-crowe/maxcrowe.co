<!DOCTYPE html>
<html>
    <head>
        <title>{{ $friendlyNameResolver(Route::currentRouteName()) }} :: Max Crowe</title>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="canonical" href="{{ request()->fullUrl() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
        <meta name="description" content="{{ $metaDescription ?? 'The personal website of Max Crowe, a web developer and musician based in Chicago, Illinois.' }}">
        @includeIf('fragments.extra-head.'.Route::currentRouteName())
    </head>
    <body>
        <x-global-header :with-background="$withBackground"/>
        <div id="content">
            {{ $slot }}
        </div>
        <script>
            {
                const menu = document.getElementById('nav');
                const overlay = document.getElementById('opacity-overlay');
                document.getElementById('mobile-menu-open').addEventListener('click', () => {
                    menu.classList.add('open');
                    overlay.classList.add('open');
                });
                overlay.addEventListener('click', () => {
                    menu.classList.remove('open');
                    overlay.classList.remove('open');
                });
            }
        </script>
        @includeIf('fragments.body-end.'.Route::currentRouteName())
    </body>
</html>
