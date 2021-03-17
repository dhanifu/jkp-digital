<div>
    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="container">
            <div class="form-group files">
                <input type="file" class="form-control @error('file') is-invalid @enderror" wire:model="file">
                @error('file')
                    <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @if($file)
            <div class="px-4 pb-4 ">
                <button class="btn btn-primary px-4 py-2 shadow">
                    Submit
                </button>
            </div>
        @endif
    </form>
</div>
