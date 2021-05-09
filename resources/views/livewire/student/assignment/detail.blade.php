<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-white">
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
                <div class="card-body">
                    <div class="card border-0">
                        <div class="card-header border-0 bg-white p-0 px-2 py-1">
                            <div class="card-title">
                                <div class="float-left"><span style="font-size: 20px;">Your Work</span></div>
                                <div class="float-right"><span style="font-size: 16px;">{!! $turned_in !!}</span></div>
                            </div>
                        </div>
                        @if($formHide == false)
                            @livewire('student.assignment.upload', ['assignment_id' => $assignment->id])
                        @else
                            <div class="card-body p-0 pt-3">
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
                                    $tipe = [
                                        'Keagamaan', 'Literasi',
                                        'Lingkungan', 'Kesehatan',
                                    ];
                                @endphp

                                <div class="grid md:grid-cols-2 gap-4">
                                    @if(Auth::user()->student->kelas == '10')
                                    @php
                                        $types[4] = 'file_pramuka';
                                        $tipe[4] = 'Pramuka';
                                    @endphp
                                @endif
                                
                                @for($i = 0; $i < count($types); $i++)
                                    <div class="card shadow-sm detail-jkp">
                                        <a href="{{ jkp($assignment->minggu_ke, $jkp->user->student->rayon->name, $types[$i],$jkp[$types[$i]]) }}" target="_blank"
                                            class="no-underline hover:no-underline">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <img src="{{ jkp($assignment->minggu_ke, $jkp->user->student->rayon->name, $types[$i],$jkp[$types[$i]]) }}"
                                                                class="detail-img shadow-sm">
                                                        </div>
                                                        <div class="col-md-8 teks">
                                                            <div class="align-middle">
                                                                <span class="text-lg font-semibold underline">{{ $tipe[$i] }}</span>
                                                                <div class="text-md font-normal no-underline hover:no-underline">{{ $jkp[$types[$i]] }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endfor
                                </div>
                                
                                <br>
                                <button class="btn bg-red-600 text-white rounded w-32 shadow mt-2" onclick="remove()"
                                        wire:click="$emit('delete', '{{ $jkp->id }}')">
                                    Unsubmit
                                    <span class="float-right">
                                        <div wire:loading class="spinner-border spinner-border-sm" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>
                                </button>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


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
    </style>
@endpush

@push('script')
	<script>
		const remove = function () {
			return confirm('Apakah Anda Yakin?') || event.stopImmediatePropagation()
		}

        $(document).ready(function(){
            $(".detail-jkp").css({transition: "all 0.1s ease-in-out"});
            $(".detail-jkp" ).hover(
                function() {
                    $(this).addClass('shadow-lg').css('cursor', 'pointer'); 
                }, function() {
                    $(this).removeClass('shadow-lg');
                }
            );
        })
	</script>
@endpush