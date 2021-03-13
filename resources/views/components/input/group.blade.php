@props([
    'label',
    'for',
    'error' => false,
    'helpText' => false,
])

<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <label for="{{ $for }}">
        {{ $label }}
    </label>

    {{ $slot }}

    @if ($error)
        <p class="text-danger">{{ $error }}</p>
    @endif

    @if ($helpText)
        <p class="text-muted">{{ $helpText }}</p>
    @endif
</div>
