<div class="col">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <span>{{ session('success') }}</span>
            <button class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <div class="card shadow">
        <div class="card-header py-3">
            <h2 class="card-title h6 font-weight-bold text-primary m-0">Data Siswa</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Rayon</th>
                            <th>Rombel</th>
                            <th>Gender</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->nis }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->rayon->name }}</td>
                                <td>{{ $student->rombel->name }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>
                                    <button class="btn btn-success btn-sm" wire:click="$emit('edit', '{{ $student->id }}')"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm" onclick="remove()" wire:click="$emit('delete', '{{ $student->id }}')"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" align="center">Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $students->links() }}
        </div>
    </div>
    <livewire:student.edit />
</div>

@push('script')
	<script>
		const remove = function () {
			return confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()
		}
	</script>
@endpush