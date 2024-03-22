@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Relawan' => '#',
    ],
])
@section('title', 'Relawan')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/simple-datatable-style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/table-datatable.css') }}">
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between pb-0">
					<a href="{{ route('dashboard.master.relawan.create') }}" class="btn btn-primary">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="h-6 w-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
						</svg>
						<span class="ms-1">Tambah Relawan</span>
					</a>
				</div>
				<div class="card-body py-4-5 table-responsive px-4">
					<table class="table-striped table" id="tabel-tasks">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Kecamatan</th>
								<th>Kontak</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($relawan as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $item->user->name }}</td>
									<td>{{ $item->district->name }}</td>
									<td>{{ formatPhone($item->user->phone) }}</td>
									<td style="white-space: nowrap">
										<a href="{{ route('dashboard.master.relawan.show', $item->uuid) }}" class="btn btn-success btn-sm">
											<i class="bi bi-list-ul"></i>
											Detail
										</a>
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
