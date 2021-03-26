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
                <x-table.heading sortable wire:click="sortBy('full_name')"
                    :direction="$sorts['full_name'] ?? null"
                    class="{{ isset($sorts['full_name']) ? 'datatable-cell-sorted' : null }}"
                >Name</x-table.heading>
                <x-table.heading>School Email</x-table.heading>
                <x-table.heading>Phone</x-table.heading>
                <x-table.heading>Actions</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse ($teachers as $teacher)
                    <x-table.row>
                        <x-table.cell hasSymbol>
                            <span style="width:250px">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 symbol symbol-40 symbol-light-primary">
                                        <span class="symbol-label font-size-h4 font-weight-bold">{{ $teacher->first_name_initial }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="mb-0 text-dark-75 font-weight-bolder font-size-lg">{{ $teacher->full_name_listing }}</div>
                                        <a class="text-muted font-weight-bold text-hover-primary" href="#">{{ $teacher->email }}</a>
                                    </div>
                                </div>
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $teacher->school_email }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $teacher->formatted_phone }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <x-icon.details link="{{ route('teachers.show', $teacher) }}" />
                            <x-icon.edit link="{{ route('teachers.edit', $teacher) }}" />
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell>No teachers found</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <div class="datatable-pager datatable-paging-loaded">
            {{ $teachers->links() }}
            <div class="datatable-pager-info my-2 mb-sm-0">
                <select wire:model="perPage" class="datatable-pager-size">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                </select>
                <span class="datatable-pager-detail">Showing {{ $teachers->firstItem() }} - {{ $teachers->lastItem() }} of {{ $teachers->total() }}</span>
            </div>
        </div>
    </div>
</div>
