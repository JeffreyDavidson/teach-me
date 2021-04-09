<div>
    <x-input.group label="Make Duplicate Of" for="duplicate" :error="$errors->first('duplicate')">
        <x-input.select
            id="default"
            wire:model="default"
            name="default"
            :options="$semesters"
            selectedOption="{{ old('default', $semester->exists ? $semester->default : '')  }}"
        />
    </x-input.group>

    <x-input.group label="Courses" for="courses_listbox" :error="$errors->first('courses')">
        <x-input.dual-listbox
            id="courses_listbox"
            wire:model="courses"
            name="courses[]"
            class="dual-listbox"
            :options="$courses"
            :selectedOptions="old('courses', $semester->courses ? $semester->courses : $courses)"
            multiple
        />
    </x-input.group>
</div>
