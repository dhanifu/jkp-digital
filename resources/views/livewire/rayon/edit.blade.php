<div>
    @if ($isOpen)
    <div class="modal backdrop d-block">
        <div class="modal-backdrop" style="background: rgba(0,0,0,.5); backdrop-filter: blur(1px);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form wire:submit.prevent="update">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="close" wire:click="$set('isOpen', false)">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('rayon.name') is-invalid @enderror"
                                    wire:model="rayon.name" placeholder="Nama" autofocus>

                                @error('rayon.name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Pembimbing</label>
                                <select wire:model="rayon.teacher_id" id="teacher_id" class="form-control @error('rayon.teacher_id') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    @php
                                        $array = [];
                                    @endphp
                                    @foreach($pembimbings as $pembimbing)
                                        @php
                                            $array[$pembimbing->teacher->id] = $pembimbing->teacher->id;
                                        @endphp
                                        <option value="{{ $pembimbing->teacher->id }}" {{ $pembimbing->teacher->id == $array[$pembimbing->teacher->id] ? 'selected' : '' }}>
                                            {{ $pembimbing->teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rayon.teacher_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary shadow" type="submit" {{$rayon['name']==null||$rayon['teacher_id']==null ? 'disabled' : ''}}>
                                Edit
                                <span class="float-right pl-2">
                                    <div wire:loading wire:target="update" class="spinner-border spinner-border-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </span>
                            </button>
                            <button type="button" class="btn btn-secondary shadow"
                                wire:click="$set('isOpen', false)">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
