<div>
    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="container">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6">
                <div class="form-group">
                    <label for="" class="font-semibold">Form Keagamaan</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" wire:model="file">
                    @error('file')
                        <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="font-semibold">Form Literasi</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" wire:model="file">
                    @error('file')
                        <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="font-semibold">Form Lingkungan</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" wire:model="file">
                    @error('file')
                        <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="font-semibold">Form Kesehatan</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" wire:model="file">
                    @error('file')
                        <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                    @enderror
                </div>

                @if (Auth::user()->student->kelas == '10')
                <div class="form-group">
                    <label for="" class="font-semibold">Form Kepramukaan</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" wire:model="file">
                    @error('file')
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
