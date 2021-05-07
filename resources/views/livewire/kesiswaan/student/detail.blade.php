<div>
    <div class="card border-0">
        <div class="card-body p-0">
            <button class="btn btn-secondary btn-circle btn-md shadow" style="margin-top: -2px" title="Kembali"
                wire:click="$emit('closeDetail')">
                <i class="fas fa-chevron-left fa-lg" wire:target="$emit('closeDetail')" wire:loading.attr="hidden"></i>
                <div wire:loading wire:target="$emit('closeDetail')" class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </button>

            <div class="mt-3">
                <div class="form-row col-md-12">
                    <div class="form-group col-md-4">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Email" disabled value="{{ $siswa->name }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nis">NIS</label>
                        <input type="text" class="form-control" id="nis" placeholder="NIS" disabled value="{{ $siswa->nis }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rayon">Rayon</label>
                        <input type="text" class="form-control" id="rayon" placeholder="Rayon" disabled value="{{ $siswa->rayon->name }}">
                    </div>
                </div>
                <div class="form-row col-md-12">
                    <div class="form-group col-md-4">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" id="kelas" placeholder="Kelas" disabled value="{{ $siswa->kelas }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rombel">Rombel</label>
                        <input type="text" class="form-control" id="rombel" placeholder="Rombel" disabled value="{{ $siswa->rombel->name }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="pembimbing">Pembimbing</label>
                        <input type="text" class="form-control" id="pembimbing" placeholder="Pembimbing" disabled value="{{ $siswa->rayon->teacher->name }}">
                    </div>
                </div>
            </div>

            <hr>

            <div class="h3 mt-3"><strong>JKP</strong></div>

            <div class="grid md:grid-cols-2 gap-4 mt-3">
                @for($i = 0; $i < count($types); $i++)
                    <div class="card shadow bg-gray-50 hover:bg-gray-100">
                        <a href="{{ jkp($assignment->minggu_ke, $jkp->user->student->rayon->name, $types[$i],$jkp[$types[$i]]) }}" target="_blank"
                            class="no-underline hover:no-underline">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ jkp($assignment->minggu_ke, $jkp->user->student->rayon->name, $types[$i],$jkp[$types[$i]]) }}"
                                                class="detail-img">
                                        </div>
                                        <div class="col-md-8 teks">
                                            <div class="align-middle">
                                                <span class="text-lg font-semibold underline">{{ $tipe[$i] }}</span>
                                                <div class="text-md font-normal no-underline hover:no-underline">{{ $jkp[$types[$i]] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
