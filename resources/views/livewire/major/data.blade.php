<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

	<div class="mb-4">
		<livewire:major.create />
	</div>
	<div>
		<div class="card shadow">
			<div class="card-header py-3">
				<div class="row mx-auto p-0">
					<div class="col-md-6 px-0">
						<h2 class="card-title h6 font-weight-bold text-primary m-0">
							Data Rayon
							<div wire:loading class="spinner-border spinner-border-sm ml-2 text-dark" role="status">
								<span class="sr-only">Loading...</span>
							</div>
						</h2>
					</div>
					<div class="col-md-6 px-0">
						<div class="inputcontainer w-48 float-right">
							<input type="search" class="form-control" placeholder="Search" wire:model="search">
							<div class="icon-container">
								<div wire:loading wire:target="search">
									<i class="loader"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				@if (session()->has('success'))
					<div class="alert alert-success alert-dismissible">
						<span>{{ session('success') }}</span>
						<button class="close" data-dismiss="alert">&times;</button>
					</div>
				@endif
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Jurusan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($majors as $major)
								<tr>
									<td>{{ $loop->iteration + $majors->firstItem() - 1 }}</td>
									<td>{{ $major->name }}</td>
									<td>
										<button class="btn btn-success btn-sm" wire:click="$emit('edit', '{{ $major->id }}')"><i class="fa fa-edit"></i></button>
										<button class="btn btn-danger btn-sm" onclick="remove()" wire:click="$emit('delete', '{{ $major->id }}')"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="4" align="center">Kosong</td>
								</tr>
							@endforelse
						</tbody>
					</table>
					{{ $majors->links() }}
				</div>
			</div>
		</div>
	</div>

	<livewire:major.edit />

</div>

@push('script')
	<script>
		const remove = function () {
			return confirm('Tindakan ini akan menghapus data rombel dan siswa yang berhubungan dengan jurusan ini. Yakin untuk hapus data ini?') || event.stopImmediatePropagation()
		}
	</script>
@endpush