<div class="checkbox-inline">
    <label class="checkbox">
    <input type="checkbox" value="1" {{ $attributes->merge(['class' => 'form-control']) }} {{  old('default') ? 'checked="checked"' : ''}}>
    <span></span>{{ $label }}</label>
</div>
