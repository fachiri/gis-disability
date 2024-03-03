@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Persebaran' => '#',
    ],
])
@section('title', 'Persebaran')
@push('css')
	<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 table-responsive px-4">
					<div id="map" style="height: 90vh"></div>
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
		const geoJsonPath = @json(asset('geojson/administrasi_kecamatan_kota_gorontalo.geojson'));
		const route = @json(route('master.penyandang.show', 'uuid'));

		const gorontaloBounds = L.latLngBounds(
			L.latLng(0.596443, 122.990913),
			L.latLng(0.477865, 123.102922)
		);

		const map = L.map('map', {
				maxBounds: gorontaloBounds,
				maxBoundsViscosity: 1.0
			})
			.setView([0.5400, 123.0600], 12);

		penyandang.forEach(e => {
			const latlng = [e.latitude, e.longitude]
			let marker = L.marker(latlng).addTo(map);
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
					layer.setStyle({
						color: '#000',
						fillOpacity: 0.3,
						weight: .5
					});
				});
			}).addTo(map);
	</script>
@endpush
