<div>
    <x-input.group label="Name" for="name" :error="$errors->first('name')">
        <x-input.text id="name" placeholder="Enter name" name="name" value="{{ old('name', $semester->exists ? $semester->name : null) }}" />
    </x-input.group>
</div>
