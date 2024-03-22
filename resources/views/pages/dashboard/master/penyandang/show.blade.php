@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Penyandang' => auth()->user()->isAdmin() ? route('dashboard.master.penyandang.index') : route('dashboard.penyandang.index'),
        $penyandang->nama => '#',
    ],
])
@section('title', 'Detail Penyandang')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/simple-datatable-style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/table-datatable.css') }}">
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="d-flex justify-content-end mb-4 gap-2">
						@if (auth()->user()->isAdmin())
							<a href="{{ route('dashboard.master.penyandang.edit', $penyandang->uuid) }}" class="btn btn-warning btn-sm">
								<i class="bi bi-pencil-square"></i>
								Edit
							</a>
							<x-form.delete :id="$penyandang->uuid" :action="route('dashboard.master.penyandang.destroy', $penyandang->uuid)" :label="$penyandang->nama" text="Hapus" />
						@endif
					</div>
					<h5 class="mb-4">Informasi</h5>
					<table class="table-striped table">
						<tr>
							<th>Nama</th>
							<td>{{ $penyandang->nama }}</td>
						</tr>
						<tr>
							<th>Nomor Induk Disabilitaas</th>
							<td>{{ $penyandang->no_induk_disabilitas }}</td>
						</tr>
						<tr>
							<th>Nomor Induk Kependudukan</th>
							<td>{{ $penyandang->nik }}</td>
						</tr>
						<tr>
							<th>Nomor Kartu Keluarga</th>
							<td>{{ $penyandang->no_kk }}</td>
						</tr>
						<tr>
							<th>Jenis Kelamin</th>
							<td>{{ $penyandang->jenis_kelamin }}</td>
						</tr>
						<tr>
							<th>Pendidikan Terakhir</th>
							<td>{{ $penyandang->pendidikan_terakhir }}</td>
						</tr>
						<tr>
							<th>Status Pernikahan</th>
							<td>{{ $penyandang->status_pernikahan }}</td>
						</tr>
						<tr>
							<th>Keterampilan</th>
							<td>{{ $penyandang->keterampilan ?? '-' }}</td>
						</tr>
						<tr>
							<th>Usaha</th>
							<td>{{ $penyandang->usaha ?? '-' }}</td>
						</tr>
						<tr>
							<th>Kontak</th>
							<td>{{ formatPhone($penyandang->kontak) }}</td>
						</tr>
						<tr>
							<th>Kecamatan</th>
							<td>{{ $penyandang->district->name }}</td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td>{{ $penyandang->alamat }}</td>
						</tr>
						<tr>
							<th>Latitude</th>
							<td>{{ $penyandang->latitude }}</td>
						</tr>
						<tr>
							<th>Longitude</th>
							<td>{{ $penyandang->longitude }}</td>
						</tr>
						<tr>
							<th>Lokasi</th>
							<td>
								<div id="map" style="height: 280px"></div>
							</td>
						</tr>
						<tr>
							<th>Jenis Disabilitas</th>
							<td>{{ $penyandang->jenis_disabilitas }}</td>
						</tr>
						<tr>
							<th>Keterangan Meninggal</th>
							<td>{{ $penyandang->keterangan_meninggal }}</td>
						</tr>
						<tr>
							<th>Keterangan Sembuh</th>
							<td>{{ $penyandang->keterangan_sembuh }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<h5 class="mb-4">File</h5>
					<table class="table-striped table">
						<tr>
							<th style="white-space: nowrap">
								Foto Diri
							</th>
							<td class="text-end">
								<img class="" style="max-width: 50%" src="{{ asset('storage/foto_diri/' . $penyandang->foto_diri) }}" alt="Foto {{ $penyandang->nama }}">
							</td>
						</tr>
						<tr>
							<th style="white-space: nowrap">
								Foto KT
							</th>
							<td class="text-end">
								<img class="" style="max-width: 50%" src="{{ asset('storage/foto_ktp/' . $penyandang->foto_ktp) }}" alt="Foto KTP {{ $penyandang->nama }}">
							</td>
						</tr>
						<tr>
							<th style="white-space: nowrap">
								Foto Diri
							</th>
							<td class="text-end">
								<img class="" style="max-width: 50%" src="{{ asset('storage/foto_kk/' . $penyandang->foto_kk) }}" alt="Foto KK {{ $penyandang->nama }}">
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<h5 class="mb-4">Bantuan</h5>
					<table class="table-striped table" id="tabel-tasks">
						<thead>
							<tr>
								<th>No</th>
								<th>Penyandang</th>
								<th>Status</th>
								<th>Jenis</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($penyandang->bantuan as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $item->penyandang->nama }}</td>
									<td>
										<x-badge.bantuan-status :status="$item->status" />	
									</td>
									<td>{{ $item->jenis }}</td>
									<td style="white-space: nowrap">
										<a href="{{ route('dashboard.bantuan.show', $item->uuid) }}" class="btn btn-success btn-sm">
											<i class="bi bi-list-ul"></i>
											Detail
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/custom/format-phone.js') }}"></script>
	<script src="{{ asset('js/extensions/simple-datatables.js') }}"></script>
	<script src="{{ asset('js/static/report.js') }}"></script>
	<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
	<script>
		// const geoJsonPath = @json(asset('administrasi_kecamatan_kota_gorontalo.geojson'));
		const penyandang_latitude = @json($penyandang->latitude) ?? 0.5400;
		const penyandang_longitude = @json($penyandang->longitude) ?? 123.0600;
		let map = L.map('map').setView([penyandang_latitude, penyandang_longitude], 13);
		let marker = L.marker([penyandang_latitude, penyandang_longitude]).addTo(map);

		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);

		L.Control.geocoder().addTo(map);

		// const fetchGeoJson = () => {
		// 	fetch("./sample.json")
		// 		.then((res) => {
		// 			if (!res.ok) {
		// 				throw new Error(`HTTP error! Status: ${res.status}`);
		// 			}
		// 			return res.json();
		// 		})
		// 		.then((data) =>
		// 			console.log(data))
		// 		.catch((error) =>
		// 			console.error("Unable to fetch data:", error));
		// }

		// console.log(geoJsonPath)
	</script>
@endpush
