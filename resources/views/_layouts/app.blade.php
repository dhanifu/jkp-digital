<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('_includes.head')
</head>
<body>
    <div id="app">
        @include('_partials.navbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @include('_partials.footer')

    @include('_includes.foot')
</body>
</html>
