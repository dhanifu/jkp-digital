@extends('_layouts.app')
@section('title' , getRayonById(request()->rayon)->name)

@section('content')
    <div class="justify-content-center">
        @livewire('kesiswaan.student.tab', ['rayon_id' => request()->rayon])
    </div>
@endsection
