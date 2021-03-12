<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('_includes.head')
</head>
<body>
    <div class="wrapper">
        @include('_partials.sidebar')
        @include('_partials.navbar')        
    </div>

    <div class="main-container">
        <div class="z-10 w-full py-4 px-1 md:p-6">
            @yield('content')
        </div>
    </div>
    
    @yield('modal')

    @include('_partials.footer')

    @include('_includes.foot')
</body>
</html>
