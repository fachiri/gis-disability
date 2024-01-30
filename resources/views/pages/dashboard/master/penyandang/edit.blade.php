@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Penyandang' => route('master.penyandang.index'),
        'Edit' => '#',
    ],
])
@section('title', 'Edit Penyandang')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="d-flex justify-content-end mb-4 gap-2">
						<a href="{{ route('master.penyandang.show', $penyandang->uuid) }}" class="btn btn-success btn-sm">
							<i class="bi bi-list-ul"></i>
							Detail
						</a>
						<x-form.delete :id="$penyandang->uuid" :action="route('master.penyandang.destroy', $penyandang->uuid)" :label="$penyandang->nama" text="Hapus" />
					</div>
					<h5 class="mb-4">Form Penyandang</h5>
					<form action="{{ route('master.penyandang.update', $penyandang->uuid) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="mb-5">
							<h5>Personal</h5>
							<x-form.input type="text" name="nama" label="Nama Penyandang" :value="$penyandang->nama" />
							<x-form.input type="text" name="no_induk_disabilitas" label="Nomor Induk Disabilitas" :value="$penyandang->no_induk_disabilitas" />
							<x-form.input type="text" name="nik" label="Nomor Induk Kependudukan" maxlength="16" :value="$penyandang->nik" />
							<x-form.input type="text" name="no_kk" label="Nomor Kartu Keluarga" maxlength="16" :value="$penyandang->no_kk" />
							<x-form.select name="jenis_kelamin" label="Jenis Kelamin" :value="$penyandang->jenis_kelamin" :options="[
							    (object) [
							        'label' => 'Laki-laki',
							        'value' => 'Laki-laki',
							    ],
							    (object) [
							        'label' => 'Perempuan',
							        'value' => 'Perempuan',
							    ],
							]" />
							<x-form.select name="pendidikan_terakhir" label="Pendidikan Terakhir" :value="$penyandang->pendidikan_terakhir" :options="[
							    (object) [
							        'label' => 'Tidak Sekolah',
							        'value' => 'Tidak Sekolah',
							    ],
							    (object) [
							        'label' => 'SD',
							        'value' => 'SD',
							    ],
							    (object) [
							        'label' => 'SMP',
							        'value' => 'SMP',
							    ],
							    (object) [
							        'label' => 'SMA/SMK',
							        'value' => 'SMA/SMK',
							    ],
							    (object) [
							        'label' => 'Diploma (D1-D3)',
							        'value' => 'Diploma (D1-D3)',
							    ],
							    (object) [
							        'label' => 'Sarjana (S1)',
							        'value' => 'Sarjana (S1)',
							    ],
							    (object) [
							        'label' => 'Magister (S2)',
							        'value' => 'Magister (S2)',
							    ],
							    (object) [
							        'label' => 'Doktor (S3)',
							        'value' => 'Doktor (S3)',
							    ],
							]" />
							<x-form.select name="status_pernikahan" label="Status Pernikahan" :value="$penyandang->status_pernikahan" :options="[
							    (object) [
							        'label' => 'Belum Menikah',
							        'value' => 'Belum Menikah',
							    ],
							    (object) [
							        'label' => 'Sudah Menikah',
							        'value' => 'Sudah Menikah',
							    ],
							]" />
							<x-form.input type="text" name="keterampilan" label="Keterampilan" :value="$penyandang->keterampilan" />
							<x-form.input type="text" name="usaha" label="Usaha" :value="$penyandang->usaha" />
						</div>
						<div class="mb-5">
							<h5>Kontak</h5>
							<x-form.input type="text" name="kontak" label="Nomor HP" format="phone" maxlength="14" :value="$penyandang->kontak" />
							<x-form.textarea type="text" name="alamat" label="Alamat" :value="$penyandang->alamat" />
							<div class="mb-3">
								<div id="map" style="height: 280px"></div>
							</div>
							<div class="row">
								<div class="col-6">
									<x-form.input type="text" name="latitude" label="Latitude" :value="$penyandang->latitude" :readonly="true" />
								</div>
								<div class="col-6">
									<x-form.input type="text" name="longitude" label="Longitude" :value="$penyandang->longitude" :readonly="true" />
								</div>
							</div>
						</div>
						<div class="mb-5">
							<h5>Disabilitas</h5>
							<x-form.input type="text" name="jenis_disabilitas" label="Jenis Disabilitas" :value="$penyandang->jenis_disabilitas" />
							<x-form.input type="text" name="keterangan_meninggal" label="Keterangan Meninggal" :value="$penyandang->keterangan_meninggal" />
							<x-form.input type="text" name="keterangan_sembuh" label="Keterangan Sembuh" :value="$penyandang->keterangan_sembuh" />
						</div>
						<div>
							<h5>Upload</h5>
							<x-form.input type="file" name="foto_diri" label="Foto Penyandang" addon-label='<i class="bi bi-image-fill"></i>' :addon-link="asset('storage/foto_diri/'. $penyandang->foto_diri)" />
							<x-form.input type="file" name="foto_ktp" label="Foto Kartu Tanda Penduduk"  addon-label='<i class="bi bi-image-fill"></i>' :addon-link="asset('storage/foto_ktp/'. $penyandang->foto_ktp)" />
							<x-form.input type="file" name="foto_kk" label="Foto Kartu Keluarga"  addon-label='<i class="bi bi-image-fill"></i>' :addon-link="asset('storage/foto_kk/'. $penyandang->foto_kk)" />
						</div>
						<div class="pt-3">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/custom/format-phone.js') }}"></script>
	<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
	<script>
		const penyandang_latitude = @json($penyandang->latitude) ?? 0.5400;
		const penyandang_longitude = @json($penyandang->longitude) ?? 123.0600;
		let map = L.map('map').setView([penyandang_latitude, penyandang_longitude], 13);
		let marker = L.marker([penyandang_latitude, penyandang_longitude]).addTo(map);

		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);

		L.Control.geocoder().addTo(map);

		map.on('click', function(e) {
			let lat = e.latlng.lat.toFixed(6);
			let lng = e.latlng.lng.toFixed(6);

			document.getElementById('latitude').value = lat;
			document.getElementById('longitude').value = lng;

			marker.setLatLng(e.latlng);
		});
	</script>
@endpush
