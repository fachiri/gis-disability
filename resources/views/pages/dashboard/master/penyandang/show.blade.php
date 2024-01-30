@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Relawan' => route('master.relawan.index'),
        $relawan->nama => '#',
    ],
])
@section('title', 'Detail Relawan')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
          <div class="d-flex gap-2 mb-4 justify-content-end">
            <a href="{{ route('master.relawan.edit', $relawan->uuid) }}" class="btn btn-warning btn-sm">
              <i class="bi bi-pencil-square"></i>
              Edit
            </a>
            <x-form.delete :id="$relawan->uuid" :action="route('master.relawan.destroy', $relawan->uuid)" :label="$relawan->nama" text="Hapus" />
          </div>
          <h5 class="mb-4">Informasi</h5>
					<table class="table-striped table">
						<tr>
							<th>Nama</th>
							<td>{{ $relawan->nama }}</td>
						</tr>
            <tr>
							<th>Email</th>
							<td>{{ $relawan->user->email }}</td>
						</tr>
						<tr>
							<th>Kontak</th>
							<td>{{ formatPhone($relawan->kontak) }}</td>
						</tr>
          </table>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/custom/format-phone.js') }}"></script>
@endpush
