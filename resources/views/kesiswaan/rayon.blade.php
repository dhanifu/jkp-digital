@extends('_layouts.app')
@section('title' , 'Rayon')
@section('content')
    <div class="justify-content-center">
        @livewire('kesiswaan.rayon')
    </div>
@endsection

@push('css')
    <style>
        .inputcontainer {
            position: relative;
        }
        .icon-container {
            position: absolute;
            right: 10px;
            top: calc(50% - 10px);
        }
        .loader {
            position: relative;
            height: 20px;
            width: 20px;
            display: inline-block;
            animation: around 5.4s infinite;
        }

        @keyframes around {
            0% {
                transform: rotate(0deg)
            }
            100% {
                transform: rotate(360deg)
            }
        }

        .loader::after, .loader::before {
            content: "";
            background: white;
            position: absolute;
            display: inline-block;
            width: 100%;
            height: 100%;
            border-width: 2px;
            border-color: rgb(100, 100, 100) rgb(100, 100, 100) transparent transparent;
            border-style: solid;
            border-radius: 20px;
            box-sizing: border-box;
            top: 0;
            left: 0;
            animation: around 0.7s ease-in-out infinite;
        }

        .loader::after {
            animation: around 0.7s ease-in-out 0.1s infinite;
            background: transparent;
        }

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
