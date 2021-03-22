<div>
    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="container">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6">
                <div class="form-group">
                    <label for="file_keagamaan" class="font-semibold">Form Keagamaan</label>
                    <input type="file" id="file_keagamaan" class="form-control @error('file_keagamaan') is-invalid @enderror" wire:model="file_keagamaan">
                    @error('file_keagamaan')
                        <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="file_literasi" class="font-semibold">Form Literasi</label>
                    <input type="file" id="file_literasi" class="form-control @error('file_literasi') is-invalid @enderror" wire:model="file_literasi">
                    @error('file_literasi')
                        <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="file_lingkungan" class="font-semibold">Form Lingkungan</label>
                    <input type="file" id="file_lingkungan" class="form-control @error('file_lingkungan') is-invalid @enderror" wire:model="file_lingkungan">
                    @error('file_lingkungan')
                        <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="file_kesehatan" class="font-semibold">Form Kesehatan</label>
                    <input type="file" id="file_kesehatan" class="form-control @error('file_kesehatan') is-invalid @enderror" wire:model="file_kesehatan">
                    @error('file_kesehatan')
                        <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                    @enderror
                </div>

                @if (Auth::user()->student->kelas == '10')
                <div class="form-group">
                    <label for="file_pramuka" class="font-semibold">Form Kepramukaan</label>
                    <input type="file" id="file_pramuka" class="form-control @error('file_pramuka') is-invalid @enderror" wire:model="file_pramuka">
                    @error('file_pramuka')
                        <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                    @enderror
                </div>
                @endif
            </div>
        </div>

        <div class="px-4 pb-4 ">
            <button class="btn btn-primary px-4 py-2 shadow">
                Submit
            </button>
        </div>
    </form>
</div>
