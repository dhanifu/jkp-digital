<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }}</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('libraries/bootstrap/dist/css/bootstrap.min.css') }}">

<script src="https://kit.fontawesome.com/f38b57ad54.js" crossorigin="anonymous"></script>
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/content.css')}}">
<link rel="stylesheet" href="{{asset('css/tailwind.css')}}">
<link rel="stylesheet" href="{{asset('css/upload.css')}}">
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
</style>
@stack('css')