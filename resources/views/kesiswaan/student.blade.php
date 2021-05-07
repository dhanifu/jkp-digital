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
