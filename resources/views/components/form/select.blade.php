<div class="mb-3">
	<label for="{{ $name }}" class="form-label">{{ $label }}</label>
	<select name="{{ $name }}" id="{{ $name }}" class="form-select @error($name) is-invalid @enderror" {{ isset($disabled) && $disabled == true ? 'disabled' : '' }} {{ isset($readonly) && $readonly == true ? 'readonly' : '' }}>
		<option value="" hidden>Pilih {{ $label }}</option>
		@foreach ($options as $option)
			<option value="{{ $option->value }}" {{ ($value ?? old($name)) == $option->value ? 'selected' : '' }}>{{ $option->label }}</option>
		@endforeach
	</select>
	@error($name)
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>
