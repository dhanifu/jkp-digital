@extends('_layouts.app')
@section('title' , 'Siswa')
@section('content')
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
                    <h2 class="card-title h6 font-weight-bold text-primary m-0">Data Siswa</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.student.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="nis" class="form-label">NIS <span class="text-danger">*</span></label>
                            <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" id="nis" value="{{ old('nis') }}">
                            @error('nis')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <div id="cek-nis"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rayon_id" class="form-label">Rayon <span class="text-danger">*</span></label>
                            <select name="rayon_id" id="rayon_id" class="form-control @error('rayon_id') is-invalid @enderror">
                                <option>-- Rayon --</option>
                                @foreach ($rayons as $rayon)
                                    <option value="{{ $rayon->id }}" {{$rayon->id == old('rayon_id') ? "selected" : ""}}>{{ $rayon->name }}</option>
                                @endforeach
                            </select>
                            @error('agama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rombel_id" class="form-label">Rombel <span class="text-danger">*</span></label>
                            <select name="rombel_id" id="rombel_id" class="form-control @error('rombel_id') is-invalid @enderror">
                                <option>-- Rombel --</option>
                                @foreach ($rombels as $rombel)
                                    <option value="{{ $rombel->id }}" {{$rombel->id == old('rombel_id') ? "selected" : ""}}>{{ $rombel->name }}</option>
                                @endforeach
                            </select>
                            @error('agama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                            <select name="kelas" id="kelas" class="form-control @error('kelas') is-invalid @enderror">
                                <option>-- Kelas --</option>
                                <option value="10" {{"10" == old('kelas') ? "selected" : ""}}>10</option>
                                <option value="11" {{"11" == old('kelas') ? "selected" : ""}}>11</option>
                                <option value="12" {{"11" == old('kelas') ? "selected" : ""}}>12</option>
                            </select>
                            @error('kelas')
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
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $("#nis").keyup(function(){
                let nis = $(this).val().trim()

                if (nis != '' && nis.length >= 8 && nis.length <= 8) {
                    $.ajax({
                        url: '{{ route('admin.student.cek-nis') }}',
                        type: 'get',
                        data: { nis: nis },
                        success: (data) => {
                            if (data.valid) {
                                $("#nis").removeClass('is-invalid')
                                $("#nis").addClass('is-valid')
                                $("#cek-nis").html(data.valid)
                            } else {
                                $("#nis").removeClass('is-valid')
                                $("#nis").addClass('is-invalid')
                                $("#cek-nis").html(data.invalid)
                            }
                        },
                        error: (err) => {
                            console.log(err)
                        }
                    })
                } else {
                    $("#nis").removeClass("is-invalid")
                    $("#nis").removeClass("is-valid")
                    $("#cek-nis").html('<span class="text-danger">Harus 8 karakter!</span>')
                }
            })
        })
    </script>
@endpush