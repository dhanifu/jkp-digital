<div>
    <div class="float-left">
        <button wire:click="$refresh" class="btn btn-primary">Refresh</button>
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
        <table class="table table-striped table-bordered mt-4">
            <thead>
                <tr>
                    <th style="width: 5px">#</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Rombel</th>
                    <th>#</th>
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
                            <button class="btn btn-info">Detail</button>
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