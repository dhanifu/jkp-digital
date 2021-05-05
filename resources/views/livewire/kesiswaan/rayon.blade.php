<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header border-0 shadow-sm" style="background: linear-gradient(90deg, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 100%);">
                <div class="card-title font-weight-bold text-primary">
                    <strong>Rayon</strong>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="inputcontainer">
                            <input type="text" class="form-control" wire:model="namaRayon" placeholder="Cari Rayon">
                            <div class="icon-container">
                                <div wire:loading wire:target="namaRayon">
                                    <i class="loader"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 ml-auto">
                        <div class="dropdown" id="export-dropdown">
                            <button class="btn btn-secondary rounded-0 shadow-sm" id="servicesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Export
                                <i class="fas fa-caret-down ml-2"></i>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right p-0 pt-2 shadow" aria-labelledby="servicesDropdown"
                                style="width: 250px">

                                <label class="dropdown-header">Minggu Ke</label>
                                <div class="dropdown-header">
                                    <select name="minggu_ke" id="minggu_ke" class="form-control rounded-0">
                                        @foreach ($weeks as $w)
                                            <option value="{{ $w->minggu_ke }}">Minggu ke {{ $w->minggu_ke }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <button type="button" class="dropdown-item border-top py-3" id="download-excel">
                                        <i class="far fa-file-excel fa-lg mr-2"></i>
                                        <span class="font-weight-700">Download Excel</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($rayons as $r)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="float-left">
                                        <div class="card-title">
                                            <strong>
                                                {{ $r->name }}
                                            </strong>
                                            <div class="h6 text-dark">
                                                <span style="font-weight: 500">{{ $r->teacher->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <button class="btn btn-light btn-circle btn-md"
                                            onclick="document.location.href='{{ route('kesiswaan.student', [$r->id]) }}'">
                                            <i class="fas fa-chevron-right fa-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body py-3">
                                    @if($namaRayon != null)
                                        <h2>Tidak dapat menemukan rayon <i>{{ $namaRayon }}</i></h2>
                                    @else
                                        <h2>Kosong</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>      
</div>

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
            
            // $.ajax({
            //     url: link,
            //     type: 'get',
            //     responseType: 'blob',
            //     data: {
            //         minggu_ke: query.minggu_ke
            //     }
            // }).then((response) => {
            //     const url = window.URL.createObjectURL(new Blob([response.data]))
            //     const link = document.createElement('a')
            // })
        })
    </script>
@endpush