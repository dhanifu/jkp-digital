<div>
    @if ($isOpen)
    <div class="modal backdrop d-block">
        <div class="modal-backdrop" style="background: rgba(0,0,0,.5);" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form wire:submit.prevent="update">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="close" wire:click="$set('isOpen', false)">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" class="form-control @error('student.nis') is-invalid @enderror"
                                    wire:model="student.nis" placeholder="11800000" autofocus>

                                @error('student.nis')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('student.name') is-invalid @enderror"
                                    wire:model="student.name" placeholder="Nama..." autofocus>

                                @error('student.name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Rayon</label>
                                <select wire:model="student.rayon_id" id="rayon_id" class="form-control @error('student.rayon_id') is-invalid @enderror">
                                    <option>-- Pilih --</option>
                                    @php
                                        $array = [];
                                    @endphp
                                    @foreach($rayons as $rayon)
                                        @php
                                            $array[$rayon->id] = $rayon->id;
                                        @endphp
                                        <option value="{{ $rayon->id }}" {{ $rayon->id == $array[$rayon->id] ? 'selected' : '' }}>
                                            {{ $rayon->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('student.rayon_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Rombel</label>
                                <select wire:model="student.rombel_id" id="rombel_id" class="form-control @error('student.rombel_id') is-invalid @enderror">
                                    <option>-- Pilih --</option>
                                    @php
                                        $array = [];
                                    @endphp
                                    @foreach($rombels as $rombel)
                                        @php
                                            $array[$rombel->id] = $rombel->id;
                                        @endphp
                                        <option value="{{ $rombel->id }}" {{ $rombel->id == $array[$rombel->id] ? 'selected' : '' }}>
                                            {{ $rombel->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('student.rayon_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kelas</label>
                                <select wire:model="student.kelas" id="kelas" class="form-control @error('student.kelas') is-invalid @enderror">
                                    <option>-- Pilih --</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                @error('student.kelas')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Agama</label>
                                <select wire:model="student.agama" id="agama" class="form-control @error('student.agama') is-invalid @enderror">
                                    <option>-- Pilih --</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                </select>
                                @error('student.agama')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Gender</label>
                                <select wire:model="student.gender" id="gender" class="form-control @error('student.gender') is-invalid @enderror">
                                    <option>-- Pilih --</option>
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                @error('student.gender')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary shadow" type="submit">Edit</button>
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
