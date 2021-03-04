@extends('_layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <span>{{ session('success') }}</span>
                        <button class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <span>{{ session('error') }}</span>
                        <button class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif
                <div id="alert"></div>
                    
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="card-title h6 font-weight-bold text-primary m-0">Data Pemimbing</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.pembimbing.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" value="{{ old('password') }}">

                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password">
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip" value="{{ old('nip') }}">
                                @error('nip')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div id="cek-nip"></div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                                <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror">
                                    <option>-- Agama --</option>
                                    @php
                                        $agama = ["Islam", "Kristen", "Hindu", "Budha"];
                                    @endphp
                                    @for($i = 0; $i < count($agama); $i++)
                                        <option value="{{ $agama[$i] }}" {{ $agama[$i] == old('agama') ? 'selected' : '' }}>
                                            {{ $agama[$i] }}
                                        </option>
                                    @endfor
                                </select>
                                @error('agama')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option>-- Jenis Kelamin --</option>
                                    <option value="L" {{"L" == old('gender') ? "selected" : ""}}>Laki-Laki</option>
                                    <option value="P" {{"P" == old('gender') ? "selected" : ""}}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" aria-describedby="photoHelp">
                                <div id="photoHelp" class="form-text">Tidak perlu diisi bila tidak ingin mengganti foto.</div>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $("#nip").keyup(function(){
                let nip = $(this).val().trim()

                if (nip != '' && nip.length >= 12) {
                    $.ajax({
                        url: '{{ route('admin.pembimbing.cek-nip') }}',
                        type: 'get',
                        data: { nip: nip },
                        success: (data) => {
                            if (data.valid) {
                                $("#nip").removeClass('is-invalid')
                                $("#nip").addClass('is-valid')
                                $("#cek-nip").html(data.valid)
                            } else {
                                $("#nip").removeClass('is-valid')
                                $("#nip").addClass('is-invalid')
                                $("#cek-nip").html(data.invalid)
                            }
                        },
                        error: (err) => {
                            console.log(err)
                        }
                    })
                } else {
                    $("#nip").removeClass("is-invalid")
                    $("#nip").removeClass("is-valid")
                    $("#cek-nip").html('<span class="text-dark">minimal 12 dan maks 18 karakter!</span>')
                }
            })
        })
    </script>
@endpush