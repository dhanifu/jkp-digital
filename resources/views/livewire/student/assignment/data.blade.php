<div>
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header border-0 h-12" style="background: linear-gradient(90deg, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 100%);">
                <div class="card-title font-weight-bold text-primary"><strong>Ditugaskan</strong>
                    <div class="float-right">
                        <button wire:click="$refresh" class="btn btn-light btn-circle btn-sm">
                            <i class="fas fa-redo-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($assignments as $a)
                        <div class="col-md-12 mb-2">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="float-left">
                                        <div class="card-title">
                                            <strong>
                                                JKP PJJ Minggu Ke {{ $a->minggu_ke }} ({{ tanggalBulan($a->from_date) }} - {{ tanggalBulan($a->to_date) }})
                                            </strong>
                                        </div>
                                        <p>{{ $a->created_at->format('d F') }}</p>
                                    </div>
                                    <div class="float-right">
                                        <button class="btn btn-light btn-circle btn-md">
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
</div>