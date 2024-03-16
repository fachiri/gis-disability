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
						<div class="card-body py-4-5 px-4 d-flex gap-3">
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
						<div class="card-body py-4-5 px-4 d-flex gap-3">
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
			{{-- <div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>Profile Visit</h4>
						</div>
						<div class="card-body">
							<div id="chart-profile-visit"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-xl-4">
					<div class="card">
						<div class="card-header">
							<h4>Profile Visit</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-7">
									<div class="d-flex align-items-center">
										<svg class="bi text-primary" width="32" height="32" fill="blue" style="width:10px">
											<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
										</svg>
										<h5 class="mb-0 ms-3">Europe</h5>
									</div>
								</div>
								<div class="col-5">
									<h5 class="mb-0 text-end">862</h5>
								</div>
								<div class="col-12">
									<div id="chart-europe"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-7">
									<div class="d-flex align-items-center">
										<svg class="bi text-success" width="32" height="32" fill="blue" style="width:10px">
											<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
										</svg>
										<h5 class="mb-0 ms-3">America</h5>
									</div>
								</div>
								<div class="col-5">
									<h5 class="mb-0 text-end">375</h5>
								</div>
								<div class="col-12">
									<div id="chart-america"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-7">
									<div class="d-flex align-items-center">
										<svg class="bi text-success" width="32" height="32" fill="blue" style="width:10px">
											<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
										</svg>
										<h5 class="mb-0 ms-3">India</h5>
									</div>
								</div>
								<div class="col-5">
									<h5 class="mb-0 text-end">625</h5>
								</div>
								<div class="col-12">
									<div id="chart-india"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-7">
									<div class="d-flex align-items-center">
										<svg class="bi text-danger" width="32" height="32" fill="blue" style="width:10px">
											<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
										</svg>
										<h5 class="mb-0 ms-3">Indonesia</h5>
									</div>
								</div>
								<div class="col-5">
									<h5 class="mb-0 text-end">1025</h5>
								</div>
								<div class="col-12">
									<div id="chart-indonesia"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-xl-8">
					<div class="card">
						<div class="card-header">
							<h4>Latest Comments</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table-hover table-lg table">
									<thead>
										<tr>
											<th>Name</th>
											<th>Comment</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="col-3">
												<div class="d-flex align-items-center">
													<div class="avatar avatar-md">
														<img src="{{ asset('images/default.jpg') }}">
													</div>
													<p class="mb-0 ms-3 font-bold">Si Cantik</p>
												</div>
											</td>
											<td class="col-auto">
												<p class="mb-0">Congratulations on your graduation!</p>
											</td>
										</tr>
										<tr>
											<td class="col-3">
												<div class="d-flex align-items-center">
													<div class="avatar avatar-md">
														<img src="{{ asset('images/default.jpg') }}">
													</div>
													<p class="mb-0 ms-3 font-bold">Si Ganteng</p>
												</div>
											</td>
											<td class="col-auto">
												<p class="mb-0">Wow amazing design! Can you make another tutorial for
													this design?</p>
											</td>
										</tr>
										<tr>
											<td class="col-3">
												<div class="d-flex align-items-center">
													<div class="avatar avatar-md">
														<img src="{{ asset('images/default.jpg') }}">
													</div>
													<p class="mb-0 ms-3 font-bold">Singh Eknoor</p>
												</div>
											</td>
											<td class="col-auto">
												<p class="mb-0">What a stunning design! You are so talented and creative!</p>
											</td>
										</tr>
										<tr>
											<td class="col-3">
												<div class="d-flex align-items-center">
													<div class="avatar avatar-md">
														<img src="{{ asset('images/default.jpg') }}">
													</div>
													<p class="mb-0 ms-3 font-bold">Rani Jhadav</p>
												</div>
											</td>
											<td class="col-auto">
												<p class="mb-0">I love your design! It’s so beautiful and unique! How did you learn to do this?</p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div> --}}
		</div>
	</section>

@endsection
@push('scripts')
	<script src="{{ asset('js/extensions/apexcharts.min.js') }}"></script>
	<script src="{{ asset('js/static/dashboard.js') }}"></script>
@endpush
