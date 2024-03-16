@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Kegiatan' => route('dashboard.activity.index'),
        $activity->name => '#',
    ],
])
@section('title', 'Detail Kegiatan')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="d-flex justify-content-end mb-4 gap-2">
						<a href="{{ route('dashboard.activity.edit', $activity->uuid) }}" class="btn btn-warning btn-sm">
							<i class="bi bi-pencil-square"></i>
							Edit
						</a>
						<x-form.delete :id="$activity->uuid" :action="route('dashboard.activity.destroy', $activity->uuid)" :label="$activity->name" text="Hapus" />
					</div>
					<table class="table-striped table">
						<tr>
							<th>Nama Kegiatan</th>
							<td>{{ $activity->name }}</td>
						</tr>
						<tr>
							<th>Lokasi</th>
							<td>{{ $activity->location }}</td>
						</tr>
						<tr>
							<th>Dokumentasi</th>
							<td>
								<div class="row">
									@foreach ($activity->documentations as $documentation)
										<span class="col-3 mb-3">
											<img src="{{ asset('storage/documentations/' . $documentation->name) }}" alt="Dokumentasi" class="w-100 border border-2" height="100" style="object-fit: cover;">
										</span>
									@endforeach
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</section>
@endsection
