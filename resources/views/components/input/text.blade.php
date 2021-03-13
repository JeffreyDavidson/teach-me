@props([
    'leadingAddOn' => false,
])

@if ($leadingAddOn)
    <span class="">
        {{ $leadingAddOn }}
    </span>
@endif

<input type="text" {{ $attributes->merge(['class' => 'form-control']) }} />
