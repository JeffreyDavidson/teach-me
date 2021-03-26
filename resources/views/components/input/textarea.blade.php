@props(['value' => ''])

<textarea {{ $attributes->merge(['class' => 'form-control']) }} rows="3">{!! $value !!}</textarea>
