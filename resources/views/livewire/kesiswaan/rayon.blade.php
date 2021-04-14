<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header border-0" style="background: linear-gradient(90deg, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 100%);">
                <div class="card-title font-weight-bold text-primary">
                    <strong>Rayon</strong>
                    <div class="float-right">
                        <input class="form-control" type="text" placeholder="Cari Rayon" wire:model="namaRayon"/>
                        <div class="text-dark" wire:loading>Mencari rayon...</div>
                        <div wire:loading.remove></div>
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
                                            onclick="document.location.href='{{ route('kesiswaan.student', [$jenisJkp,$r->id]) }}'">
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
