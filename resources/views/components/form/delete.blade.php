<button type="submit" class="btn btn-danger btn-sm d-inline" data-bs-toggle="modal" data-bs-target="#deleteForm{{ $id }}">
	<i class="bi bi-trash-fill"></i>
	{{ $text ?? '' }}
</button>
<div class="modal fade text-left" id="deleteForm{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="deleteFormModal{{ $id }}" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="deleteFormModal{{ $id }}">Konfirmasi Hapus</h4>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<i data-feather="x"></i>
				</button>
			</div>
			<form action="{{ $action }}" method="POST">
				@csrf
				@method('DELETE')
				<div class="modal-body">
					Anda akan menghapus data
					<b>{{ $label }}</b>.
					<br>
					Data yang telah terhapus, tidak dapat dikembalikan.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
						<i class="bx bx-x d-block d-sm-none"></i>
						<span class="d-none d-sm-block">Batal</span>
					</button>
					<button type="submit" class="btn btn-danger ms-1" data-bs-dismiss="modal">
						<i class="bx bx-check d-block d-sm-none"></i>
						<span class="d-none d-sm-block">Hapus</span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
