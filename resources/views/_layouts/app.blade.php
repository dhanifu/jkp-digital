<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('_includes.head')
</head>
<body class="h-full relative">

    <div class="min-h-screen block relative pb-8">
        <div class="wrapper">
            @include('_partials.sidebar')
            @include('_partials.navbar')        
        </div>
    
        <div class="main-container min-h-full">
            <div class="z-10 w-full py-4 px-1 md:p-6">
                @yield('content')
            </div>
        </div>

        @include('_partials.footer')
    </div>
    
    
    @yield('modal')


    @include('_includes.foot')
</body>
</html>
