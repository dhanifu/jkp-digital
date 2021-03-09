{{-- <!doctype html>
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

        @yield('modal')
    </div>

    @include('_partials.footer')

    @include('_includes.foot')
</body>
</html> --}}

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
        <div class="z-10 w-full p-4 md:p-6">
            @yield('content')
        </div>
        
    </div>

    @include('_partials.footer')

    @include('_includes.foot')
</body>
</html>
