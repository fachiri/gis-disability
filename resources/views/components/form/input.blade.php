<div class="mb-3">
  <label for="{{ $name }}" class="form-label">{{ $label }}</label>
  <input 
    type="{{ $type }}" 
    class="form-control @error($name) is-invalid @enderror" 
    name="{{ $name }}" 
    id="{{ $name }}" 
    value="{{ $value ?? old($name) }}" 
    format="{{ $format ?? '' }}"
    maxlength="{{ $maxlength ?? '' }}"
  />
  @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>