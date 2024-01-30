@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Relawan' => route('master.relawan.index'),
        'Edit' => '#',
    ],
])
@section('title', 'Edit Relawan')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<div class="d-flex justify-content-end mb-4 gap-2">
						<a href="{{ route('master.relawan.show', $relawan->uuid) }}" class="btn btn-success btn-sm">
							<i class="bi bi-list-ul"></i>
							Detail
						</a>
						<x-form.delete :id="$relawan->uuid" :action="route('master.relawan.destroy', $relawan->uuid)" :label="$relawan->nama" text="Hapus" />
					</div>
					<h5 class="mb-4">Form Relawan</h5>
					<form action="{{ route('master.relawan.update', $relawan->uuid) }}" method="POST">
						@csrf
            @method("PUT")
						<x-form.input type="text" name="nama" label="Nama Relawan" :value="$relawan->nama" />
						<x-form.input type="email" name="email" label="Email" :value="$relawan->user->email" />
						<x-form.input type="text" name="kontak" label="Kontak (HP)" format="phone" maxlength="14" :value="formatPhone($relawan->kontak)" />
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
