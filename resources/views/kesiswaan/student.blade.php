@extends('_layouts.app')
@section('title' , getRayonById(request()->rayon)->name)

@section('content')
    <div class="justify-content-center">
        @livewire('kesiswaan.student.tab', [
            'rayon_id' => request()->rayon
        ])
    </div>
@endsection

@push('css')
    <style>
        .detail-img {
            object-fit: none; /* Do not scale the image */
            object-position: center; /* Center the image within the element */
            width: 8rem;
            max-height: 6rem;
        }
        @media only screen and (max-width:767px){
            .detail-img {
                width: 100%;
            }
            .teks {
                margin-top: 15px;
            }
        }
        @media only screen and (max-width:760px){
            .dropdown {
                margin-top: 10px;
            }
        }

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
    </style>
@endpush

@push('script')
    <script>
        $(".dropdown-menu").click(function (e) {
            e.stopPropagation()
        })

        $("#download-excel").click(function(){
            let query = {
                minggu_ke: $("#minggu_ke").val()
            }

            let url = '{{ route('kesiswaan.export-excel', ':id') }}'
            link = url.replace(':id', '{{ request()->rayon }}') + "?" + $.param(query)

            window.location = link
        })
    </script>
@endpush
