@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Relawan' => route('dashboard.master.relawan.index'),
        'Tambah Data' => '#',
    ],
])
@section('title', 'Tambah Relawan')
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<form action="{{ route('dashboard.master.relawan.store') }}" method="POST">
						@csrf
						<x-form.select name="district_id" label="Kecamatan" :options="$districts->map(function ($district) {
						    return (object) [
						        'label' => $district->name,
						        'value' => $district->id,
						    ];
						})" />
						<x-form.input name="nama" label="Nama Relawan" />
						<x-form.input type="email" name="email" label="Email" />
						<x-form.input name="username" label="Username" />
						<x-form.select name="gender" label="Jenis Kelamin" :options="[
						    (object) [
						        'label' => App\Constants\UserGender::MALE,
						        'value' => App\Constants\UserGender::MALE,
						    ],
						    (object) [
						        'label' => App\Constants\UserGender::FEMALE,
						        'value' => App\Constants\UserGender::FEMALE,
						    ],
						]" />
						<x-form.input name="kontak" label="Kontak (HP)" format="phone" maxlength="14" />
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
	<script>
		const username = document.querySelector('#username')
		document.querySelector('#email').addEventListener('input', (e) => {
			const emailValue = e.target.value
			if (emailValue.includes('@')) {
				username.value = emailValue.split('@')[0]
			} else {
				username.value = emailValue
			}
		})
	</script>
@endpush
