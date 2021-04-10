@props([
    'options' => [],
    'selectedOption' => ''
])

<select {{ $attributes->merge(['class' => 'form-control']) }}>
    @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ $selectedOption == $value ? 'selected="selected"' : ''}}>{{ $label }}</option>
    @endforeach
</select>
