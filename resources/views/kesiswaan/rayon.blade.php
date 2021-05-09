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
        $("#download-excel").click(function(){
            let query = {
                minggu_ke: $("#minggu_ke").val()
            }

            let url = '{{ route('kesiswaan.export-all') }}'
            link = url + "?" + $.param(query)

            window.location = link
            // alert(link)
        })
    </script>
@endpush
