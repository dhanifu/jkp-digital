<div>
    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="container">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6">
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
        </div>

        <div class="px-4 pb-4 pt-2">
            @if ($file_keagamaan!=null 
                && $file_literasi!=null 
                && $file_lingkungan!=null 
                && $file_kesehatan!=null
                || (Auth::user()->student->kelas == '10' && $file_pramuka!=null))
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
        </div>
    </form>
</div>

@push('css')
    <style>
        .inputcontainer {
            position: relative;
        }
        .icon-container {
            position: absolute;
            right: 10px;
            top: calc(50% - 10px);
        }
        .loader {
            position: relative;
            height: 20px;
            width: 20px;
            display: inline-block;
            animation: around 5.4s infinite;
        }

        @keyframes around {
            0% {
                transform: rotate(0deg)
            }
            100% {
                transform: rotate(360deg)
            }
        }

        .loader::after, .loader::before {
            content: "";
            background: white;
            position: absolute;
            display: inline-block;
            width: 100%;
            height: 100%;
            border-width: 2px;
            border-color: rgb(100, 100, 100) rgb(100, 100, 100) transparent transparent;
            border-style: solid;
            border-radius: 20px;
            box-sizing: border-box;
            top: 0;
            left: 0;
            animation: around 0.7s ease-in-out infinite;
        }

        .loader::after {
            animation: around 0.7s ease-in-out 0.1s infinite;
            background: transparent;
        }
    </style>
@endpush
