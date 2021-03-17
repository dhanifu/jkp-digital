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

                                <a href="{{ jkp($assignment->minggu_ke, $jkp->user->student->rayon->name, $jkp->file) }}" 
                                    class="text-blue-700" target="_blank">
                                    {{ $jkp->file }}
                                </a>
                                <br><br>
                                <button class="btn bg-red-600 text-white rounded" onclick="remove()" wire:click="$emit('delete', '{{ $jkp->id }}')">Unsubmit</button>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
	<script>
		const remove = function () {
			return confirm('Apakah Anda Yakin?') || event.stopImmediatePropagation()
		}
	</script>
@endpush