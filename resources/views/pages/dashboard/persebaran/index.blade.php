@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Persebaran' => '#',
    ],
])
@section('title', 'Persebaran')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/simple-datatable-style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/table-datatable.css') }}">
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
	<script src="{{ asset('js/extensions/simple-datatables.js') }}"></script>
	<script src="{{ asset('js/static/report.js') }}"></script>
	<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
	<script>
		const penyandang = @json($penyandang);
		const route = @json(route('master.penyandang.show', 'uuid'));

		const map = L.map('map').setView([0.5400, 123.0600], 13);

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
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);

		L.Control.geocoder().addTo(map);
	</script>
@endpush
