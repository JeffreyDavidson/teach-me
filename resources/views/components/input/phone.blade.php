@props([
    'leadingAddOn' => false,
])

@if ($leadingAddOn)
    <span class="">
        {{ $leadingAddOn }}
    </span>
@endif

<input id="kt_inputmask_3" type="text" {{ $attributes->merge(['class' => 'form-control']) }} />
