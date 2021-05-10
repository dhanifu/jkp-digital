<div class="card shadow">
    <div class="card-header py-3">
        <h2 class="card-title h6 font-weight-bold text-primary m-0">Tambah Jurusan</h2>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store">
            <div class="form-group">
                <label>Jurusan</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                    placeholder="Nama Jurusan..." autofocus>

                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button class="btn btn-primary shadow" type="submit" {{$name==null ? 'disabled' : ''}}>
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
