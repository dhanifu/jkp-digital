<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }}</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('libraries/bootstrap/dist/css/bootstrap.min.css') }}">

<script src="https://kit.fontawesome.com/15a283483d.js" crossorigin="anonymous"></script>
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/content.css')}}">
<link rel="stylesheet" href="{{asset('css/tailwind.css')}}">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <title>Document</title>

<!-- Livewire Style -->
<livewire:styles />
<style>
    .btn-circle.btn-sm { 
        width: 35px; 
        height: 35px; 
        padding: 6px 0px;
        border-radius: 15px;
        font-size: 12px; 
        text-align: center; 
    } 
    .btn-circle.btn-md { 
        width: 40px; 
        height: 40px; 
        padding: 10px 10px; 
        margin-top: 5px;
        border-radius: 25px; 
        font-size: 10px; 
        text-align: center; 
    } 
    .btn-circle.btn-xl { 
        width: 70px; 
        height: 70px; 
        padding: 10px 16px; 
        border-radius: 35px; 
        font-size: 12px; 
        text-align: center; 
    }

    /* Loader Animation */
    .inputcontainer {
            position: relative;
        }
    .icon-container {
        position: absolute;
        right: 10px;
        top: calc(50% - 10px);
    }
    .loader {
        position: relative;
        height: 20px;
        width: 20px;
        display: inline-block;
        animation: around 5.4s infinite;
    }

    @keyframes around {
        0% {
            transform: rotate(0deg)
        }
        100% {
            transform: rotate(360deg)
        }
    }

    .loader::after, .loader::before {
        content: "";
        background: white;
        position: absolute;
        display: inline-block;
        width: 100%;
        height: 100%;
        border-width: 2px;
        border-color: rgb(100, 100, 100) rgb(100, 100, 100) transparent transparent;
        border-style: solid;
        border-radius: 20px;
        box-sizing: border-box;
        top: 0;
        left: 0;
        animation: around 0.7s ease-in-out infinite;
    }

    .loader::after {
        animation: around 0.7s ease-in-out 0.1s infinite;
        background: transparent;
    }
</style>
@stack('css')