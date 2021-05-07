<div>
    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 pt-3">
            <div class="form-group">
                <label for="file_keagamaan" class="font-semibold">Form Keagamaan</label>
                <div class="inputcontainer">
                    <input type="file" id="file_keagamaan" class="form-control @error('file_keagamaan') is-invalid @enderror" wire:model="file_keagamaan">
                    <div class="icon-container">
                        <div wire:loading wire:target="file_keagamaan">
                            <i class="loader"></i>
                        </div>
                    </div>
                </div>
                @error('file_keagamaan')
                    <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="file_literasi" class="font-semibold">Form Literasi</label>
                <div class="inputcontainer">
                    <input type="file" id="file_literasi" class="form-control @error('file_literasi') is-invalid @enderror" wire:model="file_literasi">
                    <div class="icon-container">
                        <div wire:loading wire:target="file_literasi">
                            <i class="loader"></i>
                        </div>
                    </div>
                </div>
                @error('file_literasi')
                    <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="file_lingkungan" class="font-semibold">Form Lingkungan</label>
                <div class="inputcontainer">
                    <input type="file" id="file_lingkungan" class="form-control @error('file_lingkungan') is-invalid @enderror" wire:model="file_lingkungan">
                    <div class="icon-container">
                        <div wire:loading wire:target="file_lingkungan">
                            <i class="loader"></i>
                        </div>
                    </div>
                </div>
                @error('file_lingkungan')
                    <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="file_kesehatan" class="font-semibold">Form Kesehatan</label>
                <div class="inputcontainer">
                    <input type="file" id="file_kesehatan" class="form-control @error('file_kesehatan') is-invalid @enderror" wire:model="file_kesehatan">
                    <div class="icon-container">
                        <div wire:loading wire:target="file_kesehatan">
                            <i class="loader"></i>
                        </div>
                    </div>
                </div>
                @error('file_kesehatan')
                    <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                @enderror
            </div>

            @if (Auth::user()->student->kelas == '10')
            <div class="form-group">
                <label for="file_pramuka" class="font-semibold">Form Kepramukaan</label>
                <div class="inputcontainer">
                    <input type="file" id="file_pramuka" class="form-control @error('file_pramuka') is-invalid @enderror" wire:model="file_pramuka">
                    <div class="icon-container">
                        <div wire:loading wire:target="file_pramuka">
                            <i class="loader"></i>
                        </div>
                    </div>
                </div>
                @error('file_pramuka')
                    <span class="invalid-feedback" style="font-size: 16px">{{ $message }}</span>
                @enderror
            </div>
            @endif
        </div>

        <div class="mt-4">
            @if (Auth::user()->student->kelas == '10')
                @if ($file_keagamaan!=null && $file_literasi!=null 
                    && $file_lingkungan!=null && $file_kesehatan!=null
                    && $file_pramuka!=null)
                    <button class="btn btn-primary text-white rounded w-32 shadow">
                        Submit
                        <span class="float-right">
                            <div wire:loading wire:target="upload" class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </span>
                    </button>
                @else
                    <button class="btn btn-primary text-white rounded w-32 shadow" disabled>
                        Submit
                    </button>
                @endif
            @else
                @if ($file_keagamaan!=null && $file_literasi!=null 
                    && $file_lingkungan!=null && $file_kesehatan!=null)
                    <button class="btn btn-primary text-white rounded w-32 shadow">
                        Submit
                        <span class="float-right">
                            <div wire:loading wire:target="upload" class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </span>
                    </button>
                @else
                    <button class="btn btn-primary text-white rounded w-32 shadow" disabled>
                        Submit
                    </button>
                @endif
            @endif
        </div>
    </form>
</div>
