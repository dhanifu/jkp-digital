@extends('_layouts.app')
@section('title' , 'Guru')
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
                <div class="card-header py-3">
                    <h2 class="card-title h6 font-weight-bold text-primary m-0">Data Pemimbing</h2>
                    <div class="float-right">
                        <a href="javascript:void(0)" id="reloadTable" class="btn btn-success btn-sm">Reload</a>
                        <a href="{{ route('admin.teacher.create') }}" class="btn btn-primary btn-sm">Add</a>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalExcel">
                            Upload Excel
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Modal Excel -->
    <div class="modal fade" id="modalExcel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalExcelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="modalExcelLabel">Upload Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.teacher.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="excel_file" class="text-dark">Upload Excel file</label>
                            <input type="file" name="excel_file" id="excel_file" class="form-control @error('excel_file') is-invalid @enderror">
                            @error('excel_file')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role" class="text-dark">Role</label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="">-- Role --</option>
                                <option value="pembimbing" {{ old('role') == "pembimbing" ? 'selected' : '' }}>
                                    Pembimbing
                                </option>
                                <option value="kesiswaan" {{ old('role') == 'kesiswaan' ? 'selected' : '' }}>
                                    Kesiswaan
                                </option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('libraries/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('script')
    <script>
        @if(count($errors) > 0)
            $('#modalExcel').modal('show');
        @endif
    </script>
    <script src="{{ asset('libraries/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libraries/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        const ajaxUrl = '{{ route('admin.teacher.datatables') }}'
        const editUrl = '{{ route('admin.teacher.edit', ':id') }}'
        const deleteUrl = '{{ route('admin.teacher.destroy', ':id') }}'
        const csrf = '{{ csrf_token() }}'
        const reloadTable = document.getElementById('reloadTable')
    </script>
    <script src="{{ asset('js/admin/teacher/teacher.js') }}"></script>
@endpush