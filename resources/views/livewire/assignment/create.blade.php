<div class="card shadow">
    <div class="card-header py-3">
        <h2 class="card-title h6 font-weight-bold text-primary m-0">Buat Assignment</h2>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store">
            <div class="form-group">
                <label for="minggu_ke">Minggu Ke</label>
                <input type="text" class="form-control @error('minggu_ke') is-invalid @enderror" wire:model="minggu_ke" id="minggu_ke"
                    placeholder="Minggu Ke" autofocus>

                @error('minggu_ke')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="from_date">Dari tanggal</label>
                        <input type="datetime-local" wire:model="from_date" class="form-control @error('from_date') is-invalid @enderror"
                            id="from_date">
                        @error('from_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="to_date">Sampai tanggal</label>
                        <input type="datetime-local" wire:model="to_date" class="form-control @error('to_date') is-invalid @enderror"
                            id="to_date">
                        @error('to_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-primary shadow" type="submit" {{-- $minggu_ke==null||$from_date==null||$to_date==null?'disabled':'' --}}>
                Tambah
                <span class="float-right pl-2">
                    <div wire:loading wire:target="store" class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </span>
            </button>
        </form>
    </div>
</div>