@extends('_layouts.app')
@section('title', getRayonById(request()->id)->name)

@section('content')
    <div class="justify-content-center">
        <livewire:pembimbing.students.tab />
    </div>
@endsection