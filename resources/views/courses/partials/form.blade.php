<div>
    <x-input.group label="Name" for="name" :error="$errors->first('name')">
        <x-input.text id="name" placeholder="Enter name" name="name" value="{{ old('name', $course->exists ? $course->name : null) }}" />
    </x-input.group>

    <x-input.group label="Description" for="description" :error="$errors->first('description')">
        <x-input.textarea id="description" placeholder="Enter description" name="description" value="{{ old('description', $course->exists ? $course->description : null) }}" />
    </x-input.group>
</div>
