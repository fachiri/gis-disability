@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Persebaran' => '#',
    ],
])
@section('title', 'Persebaran')
@push('css')
	<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
	<style>
		#info-container {
			position: absolute;
			bottom: 2.5rem;
			left: 2rem;
			background-color: white;
			padding: 10px;
			border-radius: 5px;
			border: 1px solid #ccc;
			z-index: 1000;
		}

		#info-container #title {
			font-weight: bold;
		}
	</style>
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 table-responsive px-4">
					<div id="map" style="height: 90vh"></div>
					<div id="info-container">
						<span id="title">Kota Gorontalo</span>
						<div id="penyandang-count">
							Jumlah Penyandang:
							<b>{{ $penyandang->count() }}</b>
						</div>
						<div id="relawan-count">
							Jumlah Relawan:
							<b>{{ $relawan->count() }}</b>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
	<script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
	<script>
		const penyandang = @json($penyandang);
		const geoJsonPath = @json(asset('geojson/administrasi_kecamatan_kota_gorontalo_2.geojson'));
		const route = @json(route('dashboard.master.penyandang.show', 'uuid'));
		const infoContainerTitle = document.querySelector('#info-container #title ');
		const penyandangCount = document.querySelector('#info-container #penyandang-count ');
		const relawanCount = document.querySelector('#info-container #relawan-count ');
		const districts = @json($districts);

		const gorontaloBounds = L.latLngBounds(
			L.latLng(0.596443, 122.990913),
			L.latLng(0.477865, 123.102922)
		);

		const map = L.map('map', {
				maxBounds: gorontaloBounds,
				maxBoundsViscosity: 1.0
			})
			.setView([0.5400, 123.0600], 12);

		const customIcon = L.icon({
			iconUrl: '{{ asset("icons/penyandang.svg") }}',
			iconSize: [32, 32],
			iconAnchor: [16, 32],
			popupAnchor: [0, -32]
		});

		penyandang.forEach(e => {
			const latlng = [e.latitude, e.longitude]
			let marker = L.marker(latlng, {icon: customIcon}).addTo(map);
			marker.bindPopup(`
				<div>
					<div class="d-flex justify-content-between align-items-center gap-1 mb-1">
						<span>Nama</span>
						<b>${e.nama}</b>
					</div>
					<div class="d-flex justify-content-between align-items-center gap-1 mb-1">
						<span>Alamat</span>
						<b>${e.alamat}</b>
					</div>
					<div class="d-flex justify-content-between align-items-center">
						<a href="${route.replace("uuid", e.uuid)}">Detail</a>
					</div>
				</div>
			`);
		});

		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			minZoom: 12,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);

		L.Control.geocoder().addTo(map);

		omnivore.geojson(geoJsonPath)
			.on('ready', function() {
				this.eachLayer(function(layer) {
					const districtName = layer.feature.properties.NAMOBJ;
					const defaultOptions = {
						fillOpacity: 0.3,
						weight: 1
					};

					layer.setStyle(defaultOptions);

					layer.on('mouseover', function(e) {
						this.setStyle({
							fillOpacity: 0.6,
							weight: 2
						});

						const selectedDistrict = districts.find(item => item.name == districtName)

						infoContainerTitle.innerHTML = districtName;
						penyandangCount.innerHTML = `Jumlah Penyandang: <b>${selectedDistrict.penyandang.length}</b>`;
						relawanCount.innerHTML = `Jumlah Relawan: <b>${selectedDistrict.relawan.length}</b>`;
					});

					layer.on('mouseout', function() {
						this.setStyle(defaultOptions);
						infoContainerTitle.innerHTML = 'Kota Gorontalo';
						penyandangCount.innerHTML = 'Jumlah Penyandang: <b>{{ $penyandang->count() }}</b>';
						relawanCount.innerHTML = 'Jumlah Relawan: <b>{{ $relawan->count() }}</b>';
					});
				});
			})
			.addTo(map);
	</script>
@endpush
