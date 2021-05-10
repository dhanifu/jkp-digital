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
                                <input type="text" class="form-control @error('rombel.name') is-invalid @enderror"
                                    wire:model="rombel.name" placeholder="Nama (ABC XII-1)" autofocus>

                                @error('rombel.name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Jurusan</label>
                                <select wire:model="rombel.major_id" id="major_id" class="form-control @error('rombel.major_id') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    @php
                                        $array = [];
                                    @endphp
                                    @foreach($majors as $major)
                                        @php
                                            $array[$major->id] = $major->id;
                                        @endphp
                                        <option value="{{ $major->id }}" {{ $major->id == $array[$major->id] ? 'selected' : '' }}>
                                            {{ $major->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rombel.major_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary shadow" type="submit" {{ $rombel['name']==null||$rombel['major_id']==null ? 'disabled' : '' }}>
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
