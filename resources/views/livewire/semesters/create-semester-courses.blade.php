<div>
    <x-input.group label="Make Duplicate Of" for="semesterIdToDuplicate" :error="$errors->first('duplicate')">
        <x-input.select
            id="semesterIdToDuplicate"
            wire:model="semesterIdToDuplicate"
            :options="$semesters"
            :selectedOptions="old('semesterIdToDuplicate', $semester->exists ? [$semester->default] : [])"
            :disabled="$semester->exists && $semester->start_date->isPast()"
        />
    </x-input.group>

    <x-input.group label="Courses" for="courses_listbox" :error="$errors->first('courses')">
        <x-input.select
            :id="$semester->exists && $semester->start_date->isFuture() ? 'courses_listbox' : 'courses'"
            name="courses[]"
            :class="$semester->exists && $semester->start_date->isFuture() ? 'dual-listbox' : ''"
            :options="$courses"
            :selectedOptions="$selectedCourses"
            multiple=true
            :disabled="$semester->exists && $semester->start_date->isPast()"
        />
    </x-input.group>
</div>

@push('scripts')
    <script>
    // Class definition
    var KTDualListbox = function() {
        // Private functions
        var coursesListBox = function () {
            // Dual Listbox
            var _this = document.getElementById('courses_listbox');

            // init dual listbox
            var dualListBox = new DualListbox(_this, {
                addEvent: function (value) {
                    @this.call('selectCourse', value);
                },
                removeEvent: function (value) {
                    @this.call('removeCourse', value);
                },
                availableTitle: 'Available courses',
                selectedTitle: 'Selected courses',
                addButtonText: 'Add',
                removeButtonText: 'Remove',
                addAllButtonText: 'Add All',
                removeAllButtonText: 'Remove All',
            });
        };

        return {
            // public functions
            init: function() {
                coursesListBox();
            },
        };
    }();

    window.addEventListener('livewire:load', function() {
        KTDualListbox.init();
    });

    window.addEventListener('initListBox', function() {
        KTDualListbox.init();
    });
    </script>
@endpush
