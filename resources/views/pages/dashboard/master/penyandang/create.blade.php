@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Penyandang' => route('dashboard.master.penyandang.index'),
        'Tambah Data' => '#',
    ],
])
@section('title', 'Tambah Penyandang')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<form action="{{ route('dashboard.master.penyandang.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="mb-5">
							<h5>Personal</h5>
							<x-form.input type="text" name="nama" label="Nama Penyandang" />
							<x-form.input type="text" name="no_induk_disabilitas" label="Nomor Induk Disabilitas" />
							<x-form.input type="text" name="nik" label="Nomor Induk Kependudukan" maxlength="16" />
							<x-form.input type="text" name="no_kk" label="Nomor Kartu Keluarga" maxlength="16" />
							<x-form.select name="jenis_kelamin" label="Jenis Kelamin" :options="[
							    (object) [
							        'label' => App\Constants\UserGender::MALE,
							        'value' => App\Constants\UserGender::MALE,
							    ],
							    (object) [
							        'label' => App\Constants\UserGender::FEMALE,
							        'value' => App\Constants\UserGender::FEMALE,
							    ],
							]" />
							<x-form.select name="pendidikan_terakhir" label="Pendidikan Terakhir" :options="[
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
							<x-form.select name="status_pernikahan" label="Status Pernikahan" :options="[
							    (object) [
							        'label' => 'Belum Menikah',
							        'value' => 'Belum Menikah',
							    ],
							    (object) [
							        'label' => 'Sudah Menikah',
							        'value' => 'Sudah Menikah',
							    ],
							]" />
							<x-form.input type="text" name="keterampilan" label="Keterampilan" />
							<x-form.input type="text" name="usaha" label="Usaha" />
						</div>
						<div class="mb-5">
							<h5>Kontak</h5>
							<x-form.input type="text" name="kontak" label="Nomor HP" format="phone" maxlength="14" />
							<x-form.textarea type="text" name="alamat" label="Alamat" />
							<x-form.select name="district_id" label="Kecamatan" :options="$districts->map(function ($district) {
							    return (object) [
							        'label' => $district->name,
							        'value' => $district->id,
							    ];
							})" />
							<div class="mb-3">
								<label class="form-label">Peta</label>
								<div id="map" style="height: 280px"></div>
							</div>
							<div class="row">
								<div class="col-6">
									<x-form.input type="text" name="latitude" label="Latitude" :readonly="true" />
								</div>
								<div class="col-6">
									<x-form.input type="text" name="longitude" label="Longitude" :readonly="true" />
								</div>
							</div>
						</div>
						<div class="mb-5">
							<h5>Disabilitas</h5>
							<x-form.input type="text" name="jenis_disabilitas" label="Jenis Disabilitas" />
							<x-form.input type="text" name="keterangan_meninggal" label="Keterangan Meninggal" />
							<x-form.input type="text" name="keterangan_sembuh" label="Keterangan Sembuh" />
						</div>
						<div>
							<h5>Upload</h5>
							<x-form.input type="file" name="foto_diri" label="Foto Penyandang" />
							<x-form.input type="file" name="foto_ktp" label="Foto Kartu Tanda Penduduk" />
							<x-form.input type="file" name="foto_kk" label="Foto Kartu Keluarga" />
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
	<script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
	<script>
		const inputKecamatan = document.querySelector('#district_id');
		var map = L.map('map').setView([0.5400, 123.0600], 12);
		var marker = L.marker([0.5400, 123.0600]).addTo(map);
		const geoJsonPath = @json(asset('geojson/administrasi_kecamatan_kota_gorontalo_2.geojson'));
		var currentLayer = null;

		inputKecamatan.addEventListener('change', e => {
			const selectedOption = e.target.selectedOptions[0];
			const value = selectedOption.value;
			const text = selectedOption.textContent;

			if (currentLayer) {
				currentLayer.setStyle({
					fillOpacity: 0.3,
					weight: 1
				});
			}

			map.eachLayer(layer => {
				if (layer.feature && layer.feature.properties && layer.feature.properties.NAMOBJ === text) {
					currentLayer = layer;
					layer.setStyle({
						fillOpacity: 0.5,
						weight: 2
					});
					map.fitBounds(layer.getBounds());
				}
			});
		});

		omnivore.geojson(geoJsonPath)
			.on('ready', function() {
				this.eachLayer(function(layer) {
					layer.setStyle({
						fillOpacity: 0.3,
						weight: 1
					});
				});
			}).addTo(map);

		map.on('click', function(e) {
			if (currentLayer) {
				if (currentLayer.getBounds().contains(e.latlng)) {
					var lat = e.latlng.lat.toFixed(6);
					var lng = e.latlng.lng.toFixed(6);

					document.getElementById('latitude').value = lat;
					document.getElementById('longitude').value = lng;

					marker.setLatLng(e.latlng);
				} else {
					alert(`Titik berada di luar wilayah ${currentLayer.feature.properties.NAMOBJ}.`);
				}
			} else {
				alert('Pilih kecamatan terlebih dahulu.');
			}
		});

		L.Control.geocoder().addTo(map);
		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			minZoom: 12,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);
	</script>
@endpush
