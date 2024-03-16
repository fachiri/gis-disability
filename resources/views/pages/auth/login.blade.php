@extends('layouts.auth')
@section('title', 'Login')
@section('content')
	@if ($errors->any())
		<div class="alert alert-light-danger color-danger alert-dismissible fade show">
			<ul class="mb-0">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	@endif
	<form action="{{ route('auth.login.authenticate') }}" method="POST" class="card-body">
		@csrf
		<x-form.input type="text" name="username" label="Username / Email" placeholder="Masukkan username / email.." />
		<x-form.input type="password" name="password" label="Password" placeholder="Masukkan password.." />
		<div class="d-flex justify-content-between">
			<div>
				<input class="form-check-input me-2" name="remember_me" type="checkbox" value="" id="remember_me" />
				<label for="remember_me">Ingat Saya</label>
			</div>
			<a href="#">Lupa Password</a>
		</div>
		<button type="submit" class="btn btn-primary btn-block fw-bold mt-5">
			Login
		</button>
	</form>
@endsection
