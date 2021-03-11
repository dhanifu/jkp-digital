@extends('_layouts.app')
@section('title', 'To-do')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <livewire:student.todo.tab />
            </div>
        </div>
    </div>
@endsection