<select {{ $attributes->merge(['class' => 'form-control']) }}>
    @foreach ($options as $option)
        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
    @endforeach
</select>
