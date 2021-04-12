@props([
    'options' => [],
    'selectedOptions' => [],
    'multiple' => false
])

<select {{ $attributes->merge(['class' => 'form-control']) }} @if ($multiple) multiple @endif>
    @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ in_array($value, array_keys($selectedOptions)) ? 'selected=selected' : ''}}>{{ $label }}</option>
    @endforeach
</select>
