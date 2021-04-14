@extends('_layouts.app')
@section('title' , ucwords(request()->jenisJkp) . " - " . getRayonById(request()->rayon)->name)

@section('content')
    <div class="justify-content-center">
        @livewire('kesiswaan.student.tab', [
            'jenisJkp' => request()->jenisJkp,
            'rayon_id' => request()->rayon
        ])
    </div>
@endsection
