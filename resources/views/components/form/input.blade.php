<div class="mb-3">
	<label for="{{ $name }}" class="form-label">{{ $label }}</label>
	<div class="{{ isset($addonLabel) ? 'input-group' : '' }}">
		<input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror {{ $class ?? '' }}" placeholder="{{ $placeholder ?? '' }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value ?? old($name) }}" format="{{ $format ?? '' }}" maxlength="{{ $maxlength ?? '' }}" {{ isset($disabled) && $disabled == true ? 'disabled' : '' }} {{ isset($readonly) && $readonly == true ? 'readonly' : '' }} />
		@if (isset($addonLabel))
			<a href="{{ $addonLink }}" class="btn btn-primary" id="button-addon-{{ $name }}">
				{!! $addonLabel !!}
			</a>
		@endif
		@error($name)
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	</div>
</div>
