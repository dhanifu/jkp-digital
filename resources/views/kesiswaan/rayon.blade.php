@extends('_layouts.app')
@section('title' , 'Rayon')
@section('content')
    <div class="justify-content-center">
        @livewire('kesiswaan.rayon')
    </div>
@endsection

@push('css')
    <style>
        @media only screen and (max-width:767px){
            #export-dropdown {
                margin-top: 10px;
            }
        }
    </style>
@endpush

@push('script')
    <script>
        $(".dropdown-menu").click(function (e) {
            e.stopPropagation()
        })
    </script>
@endpush
