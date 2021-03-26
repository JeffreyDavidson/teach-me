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
                <x-table.heading sortable wire:click="sortBy('name')"
                    :direction="$sorts['name'] ?? null"
                    class="{{ isset($sorts['name']) ? 'datatable-cell-sorted' : null }}"
                >Name</x-table.heading>
                <x-table.heading>Actions</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse ($courses as $course)
                    <x-table.row>
                        <x-table.cell>
                            <span style="width: 137px;">{{ $course->name }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <x-icon.details link="{{ route('courses.show', $course) }}" />
                            <x-icon.edit link="{{ route('courses.edit', $course) }}" />
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell>No courses found</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <x-pagination :collection="$courses" />
    </div>
</div>
