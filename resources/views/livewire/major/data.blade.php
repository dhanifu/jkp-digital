<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

	<div class="mb-4">
		<livewire:major.create />
	</div>
	<div>
		@if (session()->has('success'))
			<div class="alert alert-success alert-dismissible">
				<span>{{ session('success') }}</span>
				<button class="close" data-dismiss="alert">&times;</button>
			</div>
		@endif
		<div class="card shadow">
			<div class="card-header py-3">
				<h2 class="card-title h6 font-weight-bold text-primary m-0">Data Jurusan</h2>
			</div>
			<div class="card-body">
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
									<td>{{ $loop->iteration }}</td>
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
				</div>
				{{ $majors->links() }}
			</div>
		</div>
	</div>

	<livewire:major.edit />

</div>

@push('script')
	<script>
		const remove = function () {
			return confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()
		}
	</script>
@endpush