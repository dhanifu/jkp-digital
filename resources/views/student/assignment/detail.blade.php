@extends('_layouts.app')
@section('title' , 'Assigments')
@section('content')
    <div class="justify-content-center">
        @livewire('student.assignment.detail', ['assignment_id' => request()->id])
    </div>
@endsection
