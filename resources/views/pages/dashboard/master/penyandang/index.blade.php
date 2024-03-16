@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Penyandang' => '#',
    ],
])
@section('title', 'Penyandang')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/simple-datatable-style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/table-datatable.css') }}">
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between pb-0">
					@if (auth()->user()->isRelawan())
						<h5 class="mb-0">Daftar Penyandang di {{ auth()->user()->relawan->district->name }}</h5>
					@endif
					@if (auth()->user()->isAdmin())
						<a href="{{ route('dashboard.master.penyandang.create') }}" class="btn btn-primary">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="h-6 w-6">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
							</svg>
							<span class="ms-1">Tambah Penyandang</span>
						</a>
					@endif
				</div>
				<div class="card-body py-4-5 table-responsive px-4">
					<table class="table-striped table" id="tabel-tasks">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								@if (auth()->user()->isAdmin())
									<th>Kecamatan</th>
								@endif
								<th>Kontak</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($penyandang as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $item->nama }}</td>
									@if (auth()->user()->isAdmin())
										<td>{{ $item->district->name }}</td>
									@endif
									<td>{{ formatPhone($item->kontak) }}</td>
									<td style="white-space: nowrap">
										@if (auth()->user()->isRelawan())
											<a href="{{ route('dashboard.penyandang.show', $item->uuid) }}" class="btn btn-success btn-sm">
												<i class="bi bi-list-ul"></i>
												Detail
											</a>
										@endif
										@if (auth()->user()->isAdmin())
											<a href="{{ route('dashboard.master.penyandang.show', $item->uuid) }}" class="btn btn-success btn-sm">
												<i class="bi bi-list-ul"></i>
												Detail
											</a>
										@endif
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
	<script src="{{ asset('js/extensions/simple-datatables.js') }}"></script>
	<script src="{{ asset('js/static/report.js') }}"></script>
@endpush
