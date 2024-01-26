@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Relawan' => route('master.relawan.index'),
        'Tambah Data' => '#',
    ],
])
@section('title', 'Tambah Relawan')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<form action="{{ route('master.relawan.store') }}" method="POST">
						@csrf
						<x-form.input type="text" name="nama" label="Nama Relawan" />
						<x-form.input type="email" name="email" label="Email" />
						<x-form.input type="text" name="kontak" label="Kontak (HP)" format="phone" maxlength="14" />
						<div class="pt-3">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/custom/format-phone.js') }}"></script>
@endpush
