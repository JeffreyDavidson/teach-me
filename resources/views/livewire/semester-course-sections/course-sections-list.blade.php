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
                <x-table.heading sortable wire:click="sortBy('course')"
                    :direction="$sorts['course'] ?? null"
                    class="{{ isset($sorts['course']) ? 'datatable-cell-sorted' : null }}"
                >Course</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('start_date')"
                    :direction="$sorts['start_date'] ?? null"
                    class="{{ isset($sorts['start_date']) ? 'datatable-cell-sorted' : null }}"
                >Start Date</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('end_date')"
                    :direction="$sorts['end_date'] ?? null"
                    class="{{ isset($sorts['end_date']) ? 'datatable-cell-sorted' : null }}"
                >End Date</x-table.heading>
                <x-table.heading>Meetings</x-table.heading>
                <x-table.heading>Actions</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse ($courseSections as $section)
                    <x-table.row>
                        <x-table.cell>
                            <span style="width: 137px;">{{ $section->course->name }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $section->start_date->toDateString() }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $section->end_date->toDateString() }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;"><a href="#">View</a></span>
                        </x-table.cell>

                        <x-table.cell>

                        </x-table.cell>

                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell>No course sections found for semester.</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <x-pagination :collection="$courseSections" />
    </div>
</div>
