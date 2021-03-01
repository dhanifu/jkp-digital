@extends('_layouts.app')

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <livewire:rayon.create>
        <livewire:rayon.edit>
    </div>
    <div class="row justify-content-center">
        <livewire:rayon.data>
    </div>
</div>
@endsection