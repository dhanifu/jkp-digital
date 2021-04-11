<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header border-0 h-12" style="background: linear-gradient(90deg, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 100%);">
                <div class="card-title font-weight-bold text-primary"><strong>Rayon</strong>
                    <div class="float-right">
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
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <button class="btn btn-light btn-circle btn-md" onclick="detail('{{$r->id}}')">
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

@push('script')
    <script>
        function detail(id){
            url = '{{ route('kesiswaan.lingkungan.detail', ':id') }}'
            url = url.replace(':id', id)
            document.location.href=url
        };
    </script>
@endpush