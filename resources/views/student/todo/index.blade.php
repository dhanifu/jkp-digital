@extends('_layouts.app')
@section('title', 'To-do')

@section('content')
    <div class="justify-content-center">
        <livewire:student.todo.tab />
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $(".list-jkp" ).hover(
                function() {
                    $(this).addClass('shadow').css('cursor', 'pointer')
                }, function() {
                    $(this).removeClass('shadow')
                }
            )
        })
    </script>
@endpush