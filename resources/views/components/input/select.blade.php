<select {{ $attributes->merge(['class' => 'form-control']) }}>
    @foreach ($options as $option)
        @ddd($option)
        <option value="{{ $value }}">{{ $key }}</option>
    @endforeach
</select>
