<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ config('app.name') }} - @yield('title')</title>
		{{-- <link rel="shortcut icon" href="{{ $setting->app_logo ? asset('storage/uploads/settings/' . $setting->app_logo) : asset('images/default/jejakode.svg') }}" type="image/x-icon"> --}}
		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/app-dark.css') }}">
		<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
		@stack('css')
		<style>
			.auth-container {
				height: 100vh;
			}
			.auth-container:before {
				background-image: url('{{ asset('images/bg.jpg') }}');
				background-repeat: no-repeat;
				background-position: 50% 0;
				background-size: cover;
				content: ' ';
				display: block;
				position: absolute;
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				opacity: 0.15;
			}
		</style>
	</head>

	<body>
		<section class="">
			<div class="auth-container px-md-5 text-lg-start d-flex align-items-center px-4 text-center">
				<div class="container position-relative">
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
									<h2>@yield('title')</h2>
								</div>
								@yield('content')
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script src="{{ asset('js/dark.js') }}"></script>
		<script src="{{ asset('js/extensions/perfect-scrollbar.min.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>
		@stack('scripts')
	</body>

</html>
