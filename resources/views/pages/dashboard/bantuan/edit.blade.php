@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Bantuan' => route('dashboard.bantuan.index'),
        'Edit' => null,
    ],
])
@section('title', 'Edit Bantuan')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="d-flex justify-content-end mb-4 gap-2">
						@if ($bantuan->status === 'DIAJUKAN')
							<x-modal.confirm route="{{ route('dashboard.bantuan.received', $bantuan->uuid) }}" method="PATCH" id="bantuan-diterima" title="Konfirmasi" enctype="multipart/form-data">
								<x-slot:btn>
									<i class="bi bi-check-circle"></i>
									Diterima
								</x-slot>
								Tekan <b>KONFIRMASI</b> jika Bantuan telah diterima oleh penyandang atas nama <b>{{ $bantuan->penyandang->nama }}</b>
								<div class="my-3 border"></div>
								<x-form.input type="file" name="bukti" label="Bukti / Dokumentasi" />
							</x-modal.confirm>
						@endif
						<a href="{{ route('dashboard.bantuan.show', $bantuan->uuid) }}" class="btn btn-success btn-sm">
							<i class="bi bi-list-ul"></i>
							Detail
						</a>
						<x-form.delete :id="$bantuan->uuid" :action="route('dashboard.bantuan.destroy', $bantuan->uuid)" :label="'Bantuan ' . $bantuan->jenis . ' yang diterima oleh ' . $bantuan->penyandang->nama" text="Hapus" />
					</div>
					<h5 class="mb-4">Form Bantuan</h5>
					<form action="{{ route('dashboard.bantuan.update', $bantuan->uuid) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<x-form.select name="status" label="Status" :value="$bantuan->status" disabled="true" :options="collect(config('constants.STATUS_BANTUAN'))->map(function ($item) {
						    return (object) ['label' => $item, 'value' => $item];
						})" />
						<x-form.input name="nama" label="Nama Penerima" :value="$bantuan->penyandang->nama" disabled="true" />
						<x-form.select name="jenis" label="Jenis Bantuan" :value="$bantuan->jenis" :options="collect(config('constants.JENIS_BANTUAN'))->map(function ($item) {
						    return (object) ['label' => $item, 'value' => $item];
						})" />
						<x-form.textarea name="detail" label="Detail Bantuan" :value="$bantuan->detail" />
						<x-form.input type="file" name="bukti" label="Bukti / Dokumentasi" />
						<div class="pt-3">
							<button type="submit" class="btn btn-primary">Perbarui</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/custom/format-phone.js') }}"></script>
@endpush
