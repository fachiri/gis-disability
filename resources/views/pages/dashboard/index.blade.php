@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => '#',
    ],
])
@section('title', 'Dasbor')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/iconly.css') }}">
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-6 col-lg-6 col-md-6">
					<div class="card">
						<div class="card-body py-4-5 d-flex gap-3 px-4">
							<div class="row">
								<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
									<div class="stats-icon green mb-2">
										<i class="iconly-boldUser"></i>
									</div>
								</div>
								<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
									<h6 class="text-muted font-semibold">Relawan</h6>
									<h6 class="mb-0 font-extrabold">{{ $relawan->count() }}</h6>
								</div>
							</div>
							<div class="border"></div>
							<div>
								@foreach ($districts as $index => $district)
									<span>{{ $district->name }} <b>({{ $district->relawan->count() }})</b></span>
									@if ($index < $districts->count() - 1)
										<span>-</span>
									@endif
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-6 col-md-6">
					<div class="card">
						<div class="card-body py-4-5 d-flex gap-3 px-4">
							<div class="row">
								<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
									<div class="stats-icon red mb-2">
										<i class="iconly-boldUser"></i>
									</div>
								</div>
								<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
									<h6 class="text-muted font-semibold">Penyandang</h6>
									<h6 class="mb-0 font-extrabold">{{ $penyandang->count() }}</h6>
								</div>
							</div>
							<div class="border"></div>
							<div>
								@foreach ($districts as $index => $district)
									<span>{{ $district->name }} <b>({{ $district->penyandang->count() }})</b></span>
									@if ($index < $districts->count() - 1)
										<span>-</span>
									@endif
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-6 col-lg-6 col-md-6">
					<div class="card">
						<div class="card-body">
							<h5>Jumlah Relawan Per Kecamatan</h5>
							<div id="chart-relawan"></div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-6 col-md-6">
					<div class="card">
						<div class="card-body">
							<h5>Jumlah Penyandang Per Kecamatan</h5>
							<div id="chart-penyandang"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
@push('scripts')
	<script src="{{ asset('js/extensions/apexcharts.min.js') }}"></script>
	<script>
		const districts = @json($districts);

		console.log(districts)

		new ApexCharts(document.getElementById("chart-relawan"), {
			series: districts.map(district => district.relawan.length),
			labels: districts.map(district => district.name),
			chart: {
				type: "donut",
				width: "100%",
				height: "350px",
			},
			plotOptions: {
				pie: {
					donut: {
						size: "30%",
					},
				},
			},
		}).render()

		new ApexCharts(document.getElementById("chart-penyandang"), {
			series: districts.map(district => district.penyandang.length),
			labels: districts.map(district => district.name),
			chart: {
				type: "donut",
				width: "100%",
				height: "350px",
			},
			plotOptions: {
				pie: {
					donut: {
						size: "30%",
					},
				},
			},
		}).render()
	</script>
@endpush
