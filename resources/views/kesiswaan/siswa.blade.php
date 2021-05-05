@extends('_layouts.app')
@section('title' , 'Siswa')

@section('content')
    <div class="justify-content-center">
        @livewire('kesiswaan.siswa.tab', [
            'rayon_id' => request()->rayon
        ])
    </div>
@endsection
