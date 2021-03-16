@props([
    'leadingAddOn' => false,
])

@if ($leadingAddOn)
    <span class="">
        {{ $leadingAddOn }}
    </span>
@endif

<input id="kt_inputmask_3" type="tel" placeholder="(999) 999-9999" {{ $attributes->merge(['class' => 'form-control']) }} />
