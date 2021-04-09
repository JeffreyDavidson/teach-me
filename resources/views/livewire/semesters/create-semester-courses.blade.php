<div>
    <x-input.group label="Make Duplicate Of" for="duplicate" :error="$errors->first('duplicate')">
        <x-input.select id="default" wire:click="changeEvent($event.target.value)" name="default" :options="$semesters" selectedOption="{{ old('default', $semester->exists ? $semester->default : '')  }}" />
    </x-input.group>

    <x-input.group label="Courses" for="courses_listbox" :error="$errors->first('courses')">
        <x-input.dual-listbox wire:model="courses" id="courses_listbox" name="courses[]" class="dual-listbox" :options="$courses" :selectedOptions="old('courses', $semester->courses ? $semester->courses : [])" multiple />
    </x-input.group>
</div>
