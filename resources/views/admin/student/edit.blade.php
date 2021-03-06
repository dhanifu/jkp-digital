@extends('_layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <span>{{ session('error') }}</span>
                        <button class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif
                
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h2 class="card-title h6 font-weight-bold text-primary m-0">
                            Edit data siswa
                        </h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $student->name }}">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="rayon_id" class="form-label">Rayon <span class="text-danger">*</span></label>
                                <select name="rayon_id" id="rayon" class="form-control @error('rayon_id') is-invalid @enderror">
                                    <option>-- Rayon --</option>
                                    @php
                                        $array = [];
                                    @endphp
                                    @foreach($rayons as $rayon)
                                        @php
                                            $array[$rayon->id] = $rayon->id;
                                        @endphp
                                        <option value="{{ $rayon->id }}" {{ $student->rayon_id == $array[$rayon->id] ? 'selected' : '' }}>
                                            {{ $rayon->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rayon_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="rombel_id" class="form-label">Rombel <span class="text-danger">*</span></label>
                                <select name="rombel_id" id="rombel" class="form-control @error('rombel_id') is-invalid @enderror">
                                    <option>-- Rombel --</option>
                                    @php
                                        $array = [];
                                    @endphp
                                    @foreach($rombels as $rombel)
                                        @php
                                            $array[$rombel->id] = $rombel->id;
                                        @endphp
                                        <option value="{{ $rombel->id }}" {{ $student->rombel_id == $array[$rombel->id] ? 'selected' : '' }}>
                                            {{ $rombel->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rombel_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                                <select name="kelas" id="kelas" class="form-control @error('kelas') is-invalid @enderror">
                                    <option disabled>-- Kelas --</option>
                                    <option value="10" {{$student->kelas == "10" ? "selected" : ""}}>10</option>
                                    <option value="11" {{$student->kelas == "11" ? "selected" : ""}}>11</option>
                                    <option value="12" {{$student->kelas == "12" ? "selected" : ""}}>12</option>
                                </select>
                                @error('kelas')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                                <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror">
                                    <option disabled>-- Agama --</option>
                                    @php
                                        $agama = ["Islam", "Kristen", "Hindu", "Budha"];
                                    @endphp
                                    @for($i = 0; $i < count($agama); $i++)
                                        <option value="{{ $agama[$i] }}" {{ $agama[$i] == $student->agama ? 'selected' : '' }}>
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
                                    <option disabled>-- Jenis Kelamin --</option>
                                    <option value="L" {{$student->gender == "L" ? "selected" : ""}}>Laki-Laki</option>
                                    <option value="P" {{$student->gender == "P" ? "selected" : ""}}>Perempuan</option>
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
                            <div class="mb-3" id="foto">
                                <div id="deletefoto">
                                    <input type="checkbox" name="delete_photo" id="delete_photo">
                                    <label for="delete_photo" class="form-label">Hapus Foto Sekarang</label>
                                </div>
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
        $("#photo").change(function(){
            if ($(this).val() != "") {
                $("#deletefoto").remove()
            } else {
                $("#foto").html(`
                    <div id="deletefoto">
                        <input type="checkbox" name="delete_photo" id="delete_photo">
                        <label for="delete_photo" class="form-label">Hapus Foto Sekarang</label>
                    </div>
                `)
            }
        })
    </script>
@endpush