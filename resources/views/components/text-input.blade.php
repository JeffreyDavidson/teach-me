@props([
    'type' => "text",
    'label' => "",
    'name' => "",
    'id' => "",
    'required' => false,
    'placeholder' => "",
    'value' => ""
])

<div class="form-group">
    <label class="form-control-label">
        {{ $label }}
        @if ($required)
        <span class="text-danger">*</span>
        @endif
    </label>
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        required="{{ $required }}"
        type="{{ $type }}"
        @error($name)
        class="form-control {{ $attributes->get('class') }} is-invalid"
        @else
        class="form-control {{ $attributes->get('class') }}"
        @endif
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        @error($name)
        area-invalid="true"
        aria-describedby="email-error"
        @enderror />
    @error($name) <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
