<div>
    @if($detail)
        @livewire('kesiswaan.student.detail', [
            'rayon_id' => $rayon_id,
            'weeks' => $weeks,
            'minggu_ke' => $minggu_ke,
            'siswa' => $siswa
        ])
    @else
        <div class="card-header border-0 p-0 d-flex bg-white">
            <h3 class="card-title">
                <button wire:click="$refresh" class="btn btn-primary btn-circle btn-md shadow" style="margin-top: -2px" title="Refresh">
                    <i class="fas fa-redo-alt fa-lg" wire:target="$refresh" wire:loading.attr="hidden"></i>
                    <div wire:loading wire:target="$refresh" class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only text-lg">Loading...</span>
                    </div>
                </button>
            </h3>
            <div class="input-group col-sm-6 ml-auto p-0">
                <input type="search" id="search" class="form-control ml-3" placeholder="Search" wire:model="search">
                <select wire:model=minggu_ke id="minggu_ke" class="form-control">
                    @foreach ($weeks as $w)
                        <option value="{{ $w->minggu_ke }}">
                            Minggu Ke {{ $w->minggu_ke }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-4">
                <thead>
                    <tr>
                        <th style="width: 5px">#</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Rombel</th>
                        <th style="width: 20px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dones as $done)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $done->name }}</td>
                            <td>{{ $done->nis }}</td>
                            <td>{{ $done->kelas }}</td>
                            <td>{{ $done->rombel->name }}</td>
                            <td>
                                <button class="btn btn-primary w-32 shadow" wire:click="showDetail('{{ $done->id }}')">
                                    Detail
                                    <span class="float-right">
                                        <div wire:loading wire:target="showDetail('{{ $done->id }}')" class="spinner-border spinner-border-sm" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" align="center">Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>

@push('script')
    <script>
        window.onscroll = function(ev) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                window.livewire.emit('load-more');
            }
        };
    </script>
@endpush