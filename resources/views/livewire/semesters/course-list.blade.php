<div>
    <div class="mb-7">
        <div class="row align-items-center">
            <x-search />
        </div>
    </div>

    <div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable wire:click="sortBy('course')"
                    :direction="$sorts['course'] ?? null"
                    class="{{ isset($sorts['course']) ? 'datatable-cell-sorted' : null }}"
                >Course</x-table.heading>
                <x-table.heading>Number of Students</x-table.heading>
                <x-table.heading>Sections</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse ($courses as $course)
                    @dd($course->courseSectionSemesters()->where('semester_id', 1)->get()->sum('students_count'))
                    <x-table.row>
                        <x-table.cell>
                            <span style="width: 137px;">{{ $course->name }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $course->students_count }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;"><a href="{{ route('semesters.courses.sections.index', [$semester, $course]) }}">View</a></span>
                        </x-table.cell>

                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell>No courses found for semester.</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <x-pagination :collection="$courses" />
    </div>
</div>
