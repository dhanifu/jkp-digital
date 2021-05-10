<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

	<div class="mb-4">
		<livewire:rombel.create />
	</div>
	<div>
		<div class="card shadow">
			<div class="card-header py-3">
				<div class="row mx-auto p-0">
					<div class="col-md-6 px-0">
						<h2 class="card-title h6 font-weight-bold text-primary m-0">
							Data Rombel
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
								<th>Rombel</th>
                                <th>Jurusan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($rombels as $rombel)
								<tr>
									<td>{{ $loop->iteration + $rombels->firstItem() - 1 }}</td>
									<td>{{ $rombel->name }}</td>
									<td>{{ $rombel->major->name }}</td>
									<td>
										<button class="btn btn-success btn-sm" wire:click="$emit('edit', '{{ $rombel->id }}')" onclick="edit('{{ $rombel->id }}')">
											<i class="fa fa-edit" id="fa-{{ $rombel->id }}"></i>
											<div class="spinner-border spinner-border-sm" role="status" id="spinner-{{ $rombel->id }}" hidden>
												<span class="sr-only text-lg">Loading...</span>
											</div>
										</button>
										<button class="btn btn-danger btn-sm" onclick="remove()" wire:click="$emit('delete', '{{ $rombel->id }}')"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="4" align="center">Kosong</td>
								</tr>
							@endforelse
						</tbody>
					</table>
					{{ $rombels->links() }}
				</div>
			</div>
		</div>
	</div>

	<livewire:rombel.edit />

</div>

@push('script')
	<script>
		const remove = function () {
			return confirm('Tindakan ini akan menghapus semua data siswa yang berhubungan dengan rombel ini. Yakin untuk hapus data ini?') || event.stopImmediatePropagation()
		}

		function edit(id) {
			$(`#fa-${id}`).attr('hidden', true)
			$(`#spinner-${id}`).attr('hidden', false)
			setTimeout(() => {
				$(`#fa-${id}`).attr('hidden', false)
				$(`#spinner-${id}`).attr('hidden', true)
			}, 1500);
		}
	</script>
@endpush