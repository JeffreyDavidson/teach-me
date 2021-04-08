@props([
    'options' => [],
    'selectedOptions' => [],
])

<select {{ $attributes->merge(['class' => 'form-control']) }}>
    @foreach ($options as $option)
        <option value="{{ $option['value'] }}" {{ in_array($option['value'], $selectedOptions) ? 'selected="selected"' : '' }}>{{ $option['label'] }}</option>
    @endforeach
</select>
