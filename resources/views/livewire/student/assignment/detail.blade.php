<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card border-0">
                        <div class="card-title" style="font-size: 25px; color: #16285f">
                            <strong>
                                JKP PJJ Minggu Ke {{ $assignment->minggu_ke }} ({{ tanggalBulan($assignment->from_date) }} - {{ tanggalBulan($assignment->to_date) }})
                            </strong>
                            <div class="h6 text-dark">
                                <span style="font-weight: 500">JKP Digital • {{ $assignment->created_at->format('M d') }}</span>
                                <span class="float-right">
                                    {!! dueDate($assignment->to_date) !!}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mt-4">
                        <div class="card-header border-0" style="background: #fff">
                            <div class="card-title">
                                <div class="float-left"><span style="font-size: 20px;">Your Work</span></div>
                                <div class="float-right"><span style="font-size: 16px;">{!! $turned_in !!}</span></div>
                            </div>
                        </div>
                        @if($formHide == false)
                            @livewire('student.assignment.upload', ['assignment_id' => $assignment->id])
                        @else
                            <div class="card-body">
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <span>{{ session('success') }}</span>
                                        <button class="close" data-dismiss="alert">&times;</button>
                                    </div>
                                @endif

                                @php
                                    $types = [
                                        'file_keagamaan', 'file_literasi',
                                        'file_lingkungan', 'file_kesehatan'
                                    ];
                                @endphp

                                <div class="grid md:grid-cols-2 gap-4">
                                    @if(Auth::user()->student->kelas == '10')
                                    @php $types[4] = 'file_pramuka'; @endphp
                                @endif
                                
                                @for($i = 0; $i < count($types); $i++)
                                    <a href="{{ jkp($assignment->minggu_ke, $jkp->user->student->rayon->name, $types[$i],$jkp[$types[$i]]) }}" 
                                        class="p-2 shadow-md border rounded-md flex items-center hover:bg-gray-50" target="_blank">    
                                        <img src="{{ jkp($assignment->minggu_ke, $jkp->user->student->rayon->name, $types[$i],$jkp[$types[$i]]) }}" alt="..." class="p-2 w-12 h-12 sm:w-24 sm:h-24">
                                        <div class="p-2 text-md font-semibold">{{ $jkp[$types[$i]] }}</div>                                    
                                    </a>

                                @endfor
                                </div>
                                
                                <br>
                                <button class="btn bg-red-600 text-white rounded w-32 shadow" onclick="remove()"
                                        wire:click="$emit('delete', '{{ $jkp->id }}')">
                                    Unsubmit
                                    <span class="float-right">
                                        <div wire:loading class="spinner-border spinner-border-sm" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>
                                </button>
                            </>
                        @endif
                    </div>

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
    </style>
@endpush

@push('script')
	<script>
		const remove = function () {
			return confirm('Apakah Anda Yakin?') || event.stopImmediatePropagation()
		}
	</script>
@endpush