@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Relawan' => route('dashboard.master.relawan.index'),
        $relawan->user->name => '#',
    ],
])
@section('title', 'Detail Relawan')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/simple-datatable-style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/table-datatable.css') }}">
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="d-flex justify-content-end mb-4 gap-2">
						<a href="{{ route('dashboard.master.relawan.edit', $relawan->uuid) }}" class="btn btn-warning btn-sm">
							<i class="bi bi-pencil-square"></i>
							Edit
						</a>
						<x-form.delete :id="$relawan->uuid" :action="route('dashboard.master.relawan.destroy', $relawan->uuid)" :label="$relawan->nama" text="Hapus" />
					</div>
					<h5 class="mb-4">Informasi</h5>
					<table class="table-striped table">
						<tr>
							<th>Nama</th>
							<td>{{ $relawan->user->name }}</td>
						</tr>
						<tr>
							<th>Jenis Kelamin</th>
							<td>{{ $relawan->user->gender }}</td>
						</tr>
						<tr>
							<th>Username</th>
							<td>{{ $relawan->user->username }}</td>
						</tr>
						<tr>
							<th>Email</th>
							<td>{{ $relawan->user->email }}</td>
						</tr>
						<tr>
							<th>Kontak</th>
							<td>{{ formatPhone($relawan->user->phone) }}</td>
						</tr>
						<tr>
							<th>Kecamatan</th>
							<td>{{ $relawan->district->name }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between pb-0">
					<h5 class="mb-0">Daftar Penyandang</h5>
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
							@foreach ($relawan->penyandang as $item)
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
	<script src="{{ asset('js/custom/format-phone.js') }}"></script>
	<script src="{{ asset('js/extensions/simple-datatables.js') }}"></script>
	<script src="{{ asset('js/static/report.js') }}"></script>
@endpush
