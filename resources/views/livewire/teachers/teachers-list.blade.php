<div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
    <x-table>
        <x-slot name="head">
            <x-table.heading>Name</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @forelse ($teachers as $teacher)
            <x-table.row>
                <x-table.cell hasSymbol>
                    <span style="width: 250px;">
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
            </x-table.row>
            @empty
            <x-table.row>
                <x-table.cell>No Teachers Hired</x-table.cell>
            </x-table.row>
            @endforelse
        </x-slot>
    </x-table>

    <div class="datatable-pager datatable-paging-loaded">
        {{ $teachers->links() }}
        <div class="datatable-pager-info my-2 mb-sm-0">
            <select wire:model="perPage" class="datatable-pager-size">
                <option class="" value=""></option>
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
