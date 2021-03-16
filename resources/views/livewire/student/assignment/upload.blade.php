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

        <div class="px-4 pb-4 ">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
        </div>
    </form>
</div>
