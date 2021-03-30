<div>
    <div class="mb-7">
        <div class="row align-items-center">
            <div class="col-md-6 my-2 my-md-0">
                <div class="input-icon mr-4">
                    <input type="text" wire:model="filters.search" class="form-control" id="search_query" placeholder="Search...">
                    <span><i class="flaticon2-search-1 text-muted"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable wire:click="sortBy('semester')"
                    :direction="$sorts['semester'] ?? null"
                    class="{{ isset($sorts['semester']) ? 'datatable-cell-sorted' : null }}"
                >Semester</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('name')"
                    :direction="$sorts['name'] ?? null"
                    class="{{ isset($sorts['name']) ? 'datatable-cell-sorted' : null }}"
                >Name</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('teacher_name')"
                    :direction="$sorts['teacher_name'] ?? null"
                    class="{{ isset($sorts['teacher_name']) ? 'datatable-cell-sorted' : null }}"
                >Teacher</x-table.heading>
                <x-table.heading>Actions</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse ($courseSections as $section)
                    <x-table.row>
                        <x-table.cell>
                            <span style="width: 137px;">{{ $section->semester }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $section->name }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <a class="text-body" href="{{ route('teachers.show', $section->teacher) }}"><span style="width: 137px;">{{ $section->teacher_name }}</span></a>
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell>No course sections found</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <x-pagination :collection="$courseSections" />
    </div>
</div>
