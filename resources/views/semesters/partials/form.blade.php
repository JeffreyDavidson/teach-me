<div>
    <div class="row">
        <div class="col-md-6">
            <x-input.group label="Term" for="term" :error="$errors->first('term')">
                <x-input.select id="term" name="term" :options="$terms" selectedOption="{{ old('term', $semester->exists ? $semester->term : '') }}" />
            </x-input.group>
        </div>
        <div class="col-md-6">
            <x-input.group label="Year" for="year" :error="$errors->first('year')">
                <x-input.select id="year" name="year" :options="$years" selectedOption="{{ old('year', $semester->exists ? $semester->year : '')  }}" />
            </x-input.group>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-input.group label="Start Date" for="start_date" :error="$errors->first('start_date')">
                <x-input.date id="example-date-input" placeholder="" name="start_date" value="{{ old('start_date', $semester->exists ? $semester->start_date : today()->format('Y-m-d')) }}" />
            </x-input.group>
        </div>
        <div class="col-md-6">
            <x-input.group label="End Date" for="end_date" :error="$errors->first('end_date')">
                <x-input.date id="example-date-input" placeholder="" name="end_date" value="{{ old('end_date', $semester->exists ? $semester->end_date : today()->format('Y-m-d')) }}" />
            </x-input.group>
        </div>
    </div>

    <x-input.group label="Make Default Semester Courses" for="default" :error="$errors->first('default')">
        <x-input.checkbox id="default" name="default" label="Yes" />
    </x-input.group>

    <x-input.group label="Courses" for="kt_dual_listbox_1" :error="$errors->first('courses')">
        <x-input.dual-listbox id="kt_dual_listbox_1" name="courses[]" class="dual-listbox" :options="$courses" multiple />
    </x-input.group>
</div>
