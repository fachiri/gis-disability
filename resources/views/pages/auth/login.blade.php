@extends('layouts.auth')
@section('title', 'Login')
@push('css')
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
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
	<section>
		<div class="auth-container px-md-5 text-lg-start d-flex align-items-center px-4 text-center">
			<div class="position-relative container">
				<div class="row gx-lg-5 align-items-center">
					<div class="col-lg-6 mb-lg-0 mb-5">
						<h1 class="display-3 fw-bold ls-tight mb-4">
							Empowering <br />
							<span class="text-primary">{{ config('app.name') }}</span>
						</h1>
						<p class="fw-medium fs-5">
							{{ config('app.name') }} adalah platform yang memungkinkan relawan dan admin untuk melakukan pendataan penyandang disabilitas, dilengkapi dengan pemetaan (GIS) untuk lokasi penyandang disabilitas dan pengelolaan bantuan kepada penyandang dari relawan di tiap-tiap lokasi tertentu.
						</p>
					</div>
					<div class="col-lg-6 mb-lg-0 mb-5">
						<div class="card p-md-3">
							<div class="card-header">
								<h2>Login</h2>
							</div>
							@if ($errors->any())
								<div class="alert alert-light-danger color-danger alert-dismissible fade show">
									<ul class="mb-0">
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							@endif
							<form action="{{ route('auth.login.authenticate') }}" method="POST" class="card-body">
								@csrf
								<x-form.input type="text" name="username" label="Username / Email" placeholder="Masukkan username / email.." />
								<x-form.input type="password" name="password" label="Password" placeholder="Masukkan password.." />
								<div class="d-flex justify-content-between">
									<div>
										<input class="form-check-input me-2" name="remember_me" type="checkbox" value="" id="remember_me" />
										<label for="remember_me">Ingat Saya</label>
									</div>
									<a href="#">Lupa Password</a>
								</div>
								<button type="submit" class="btn btn-primary btn-block fw-bold mt-5">
									Login
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section style="min-height: 100vh;">
		<div class="px-md-5 px-4">
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
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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
			iconUrl: `{{ asset('icons/penyandang_3.svg') }}`,
			iconSize: [32, 32],
			iconAnchor: [16, 32],
			popupAnchor: [0, -32]
		});

		penyandang.forEach(e => {
			const latlng = [e.latitude, e.longitude]
			let marker = L.marker(latlng, {
				icon: customIcon
			}).addTo(map);
		});

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

		L.Control.geocoder().addTo(map);

		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			minZoom: 12,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);
	</script>
@endpush
