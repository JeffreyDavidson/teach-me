@props(['options' => []])

<select {{ $attributes->merge(['class' => 'form-control']) }}>
    @foreach($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
