@extends('_layouts.app')
@section('title' , ucwords(request()->jenisJkp))
@section('content')
    <div class="justify-content-center">
        @livewire('kesiswaan.rayon', ['jenisJkp' => request()->jenisJkp])
    </div>
@endsection
