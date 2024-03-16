@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Bantuan' => route('dashboard.bantuan.index'),
        $bantuan->jenis => null,
    ],
])
@section('title', 'Detail Bantuan')
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
						<a href="{{ route('dashboard.bantuan.edit', $bantuan->uuid) }}" class="btn btn-warning btn-sm">
							<i class="bi bi-pencil-square"></i>
							Edit
						</a>
						<x-form.delete :id="$bantuan->uuid" :action="route('dashboard.bantuan.destroy', $bantuan->uuid)" :label="'Bantuan ' . $bantuan->jenis . ' yang diterima oleh ' . $bantuan->penyandang->nama" text="Hapus" />
					</div>
					<table class="table-striped table">
						<tr>
							<th>Status</th>
							<td>{{ $bantuan->status }}</td>
						</tr>
						<tr>
							<th>Nama Penerima</th>
							<td>{{ $bantuan->penyandang->nama }}</td>
						</tr>
						<tr>
							<th>Jenis</th>
							<td>{{ $bantuan->jenis }}</td>
						</tr>
						<tr>
							<th>Detail</th>
							<td>{{ $bantuan->detail }}</td>
						</tr>
						@if ($bantuan->status === 'DITERIMA')
							<tr>
								<th>Bukti</th>
								<td>
									<a href="{{ asset('storage/bukti/' . $bantuan->bukti) }}">{{ $bantuan->bukti }}</a>
								</td>
							</tr>
						@endif
					</table>
				</div>
			</div>
		</div>
	</section>
@endsection
