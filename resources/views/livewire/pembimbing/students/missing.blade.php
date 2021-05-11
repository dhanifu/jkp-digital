<div>
    <div class="float-left">
        <button wire:click="$refresh" class="btn btn-primary btn-circle btn-md shadow" style="margin-top: -2px" title="Refresh">
            <i class="fas fa-redo-alt fa-lg" wire:target="$refresh" wire:loading.attr="hidden"></i>
            <div wire:loading wire:target="$refresh" class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only text-lg">Loading...</span>
            </div>
        </button>
    </div>

    <div class="float-right">
        <select wire:model=minggu_ke id="minggu_ke" class="form-control" style="width: 200px">
            @foreach ($weeks as $w)
                <option value="{{ $w->minggu_ke }}">
                    Minggu Ke {{ $w->minggu_ke }}
                </option>
            @endforeach
        </select>

        {{-- <div class="btn-group-vertical">
            <button class="btn btn-success ml-2" type="button">
                Excel &nbsp;&nbsp; <i class="far fa-file-excel"></i>
            </button>
        </div> --}}
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered mt-4" wire:loading.class="loading" wire:target="minggu_ke">
            <thead>
                <tr>
                    <th style="width: 5px">#</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Rombel</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($missings as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s['name'] }}</td>
                        <td>{{ $s['nis'] }}</td>
                        <td>{{ $s['kelas'] }}</td>
                        <td>{{ $s['rombel']['name'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" align="center">Kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
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