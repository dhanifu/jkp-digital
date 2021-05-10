<div>
    <div class="card border-0">
        <div class="card-header border-0 h-12" style="background: linear-gradient(90deg, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 100%);">
            <div class="card-title font-weight-bold text-primary m-0"><strong>Selesai</strong>
                <div class="float-right">
                    <button wire:click="$refresh" class="btn btn-light btn-circle btn-sm" style="margin-top: -5px">
                        <i class="fas fa-redo-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body" style="padding: 10px 10px 10px">
            <div class="row">
                @forelse ($jkp_dones as $j)
                    <div class="col-md-12 mb-3">
                        <div class="card list-jkp" onclick="detail('{{$j->assignment->id}}')">
                            <div class="card-body">
                                <div class="float-left">
                                    <div class="card-title">
                                        <strong>
                                            JKP PJJ Minggu Ke {{ $j->assignment->minggu_ke }} ({{ tanggalBulan($j->assignment->from_date) }} - {{ tanggalBulan($j->assignment->to_date) }})
                                        </strong>
                                    </div>
                                    <p>{{ $j->assignment->created_at->format('d F') }}</p>
                                </div>
                                <div class="float-right">
                                    <button class="btn btn-light btn-circle btn-md" onclick="detail('{{ $j->assignment->id }}')">
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
                                <h2>Kosong</h2>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


@push('script')
    <script>
        function detail(id){
            url = '{{ route('student.assignments.detail', ':id') }}'
            url = url.replace(':id', id)
            document.location.href=url
        }

        window.onscroll = function(ev) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                window.livewire.emit('load-more');
            }
        };
    </script>
@endpush