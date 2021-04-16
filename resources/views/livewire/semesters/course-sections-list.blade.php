<div>
    <div class="mb-7">
        <div class="row align-items-center">
            <x-search />
        </div>
    </div>

    <div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable wire:click="sortBy('day')"
                    :direction="$sorts['day'] ?? null"
                    class="{{ isset($sorts['day']) ? 'datatable-cell-sorted' : null }}"
                >Day</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('start_time')"
                    :direction="$sorts['start_time'] ?? null"
                    class="{{ isset($sorts['start_time']) ? 'datatable-cell-sorted' : null }}"
                >Time</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('teacher')"
                    :direction="$sorts['teacher'] ?? null"
                    class="{{ isset($sorts['teacher']) ? 'datatable-cell-sorted' : null }}"
                >Teacher</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('students_count')"
                    :direction="$sorts['students_count'] ?? null"
                    class="{{ isset($sorts['students_count']) ? 'datatable-cell-sorted' : null }}"
                >Students Count</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse ($courseSections as $section)
                    <x-table.row>
                        <x-table.cell>
                            <span style="width: 137px;">{{ $section->day }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $section->start_time }} to {{ $section->end_time }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $section->teacher->full_name }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $section->students_count }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <x-icon.details link="{{ route('semesters.courses.sections.show', [$semester, $course, $section]) }}" />
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell>No course sections found for course.</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <x-pagination :collection="$courseSections" />
    </div>
</div>
