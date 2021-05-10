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
                <div class="card-header py-3">
                    <h2 class="card-title h6 font-weight-bold text-primary m-0">Data Siswa</h2>
                    <div class="float-right">
                        <a href="javascript:void(0)" id="reloadTable" class="btn btn-success btn-sm">Reload</a>
                        <a href="{{ route('admin.student.create') }}" class="btn btn-primary btn-sm">Add</a>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="modalExcelLabel"><strong>Upload Excel</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.student.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" name="excel_file" class="form-control">
                        <span class="text-danger text-sm">{{ $errors->first('excel_file') }}</span>
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
        const ajaxUrl = '{{ route('admin.student.datatables') }}'
        const editUrl = '{{ route('admin.student.edit', ':id') }}'
        const deleteUrl = '{{ route('admin.student.destroy', ':id') }}'
        const csrf = '{{ csrf_token() }}'
        const reloadTable = document.getElementById('reloadTable')
    </script>
    <script src="{{ asset('js/admin/student/student.js') }}"></script>
@endpush