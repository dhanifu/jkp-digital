<div>
    
        <div class="row">
            <form wire:submit.prevent="store" class="d-flex">
                <div class="col-sm-6">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h2 class="card-title h6 font-weight-bold text-primary m-0">Tambah Siswa</h2>
                        </div>
                        <div class="card-body">
                            {{-- nis --}}
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email"
                                    placeholder="example@email.com" autofocus>
                
                                @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- nama --}}
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password"
                                    placeholder="Password..." autofocus>
                
                                @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h2 class="card-title h6 font-weight-bold text-primary m-0">Data Diri</h2>
                        </div>
                        <div class="card-body">
                            {{-- nis --}}
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" class="form-control @error('nis') is-invalid @enderror" wire:model="nis"
                                    placeholder="11800000" autofocus>
                
                                @error('nis')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- nama --}}
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                                    placeholder="Nama..." autofocus>
                
                                @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- rayon --}}
                            <div class="form-group">
                                <label>Rayon</label>
                                <select style="width: 100%" class="form-control  @error('rayon_id') is-invalid @enderror" wire:model="rayon_id">
                                    <option>-- Select --</option>
                                    @foreach ($rayons as $rayon)
                                        <option value="{{ $rayon->id }}">{{ $rayon->name }}</option>
                                    @endforeach
                                </select>
                
                                @error('rayon_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- rombel --}}
                            <div class="form-group">
                                <label>Rombel</label>
                                <select style="width: 100%" class="form-control  @error('rombel_id') is-invalid @enderror" wire:model="rombel_id">
                                    <option>-- Select --</option>
                                    @foreach ($rombels as $rombel)
                                        <option value="{{ $rombel->id }}">{{ $rombel->name }}</option>
                                    @endforeach
                                </select>
                
                                @error('rombel_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- kelas --}}
                            <div class="form-group">
                                <label>Kelas</label>
                                <select style="width: 100%" class="form-control  @error('kelas') is-invalid @enderror" wire:model="kelas">
                                    <option>-- Select --</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                
                                @error('kelas')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- agama --}}
                            <div class="form-group">
                                <label>Agama</label>
                                <select style="width: 100%" class="form-control  @error('agama') is-invalid @enderror" wire:model="agama">
                                    <option>-- Select --</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                </select>
                
                                @error('kelas')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- jenis kelamin --}}
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select style="width: 100%" class="form-control  @error('gender') is-invalid @enderror" wire:model="gender">
                                    <option>-- Select --</option>
                                    <option value="L">Laki - laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                
                                @error('gender')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" wire:model="photo" name="photo">
                                @error('photo')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-primary shadow" type="submit">Tambah</button>
                            
                        </div>        
                    </div> 
                </div>
            </form>
            <livewire:student.data />
        </div>
        
        
    
       
</div>
