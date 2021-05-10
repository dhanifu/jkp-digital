<div class="card shadow">
    <div class="card-header py-3">
        <h2 class="card-title h6 font-weight-bold text-primary m-0">Tambah Rayon</h2>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store">
            <div class="form-group">
                <label>Rayon</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                    placeholder="Nama" autofocus>

                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Pembimbing</label>
                <select style="width: 100%" class="form-control  @error('teacher_id') is-invalid @enderror" wire:model="teacher_id">
                    <option value="">-- Select --</option>
                    @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->teacher->id }}">{{ $teacher->teacher->name }}</option>
                    @endforeach
                </select>

                @error('teacher_id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button class="btn btn-primary shadow" type="submit" {{$name==null||$teacher_id==null ? 'disabled' : ''}}>Tambah
                <span class="float-right pl-2">
                    <div wire:loading wire:target="store" class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </span>
            </button>
        </form>
    </div>
</div>
