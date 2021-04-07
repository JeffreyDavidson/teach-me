<div>
    <div class="mb-7">
        <div class="row align-items-center">
            <x-search />
        </div>
    </div>

    <div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable wire:click="sortBy('full_name')"
                    :direction="$sorts['full_name'] ?? null"
                    class="{{ isset($sorts['full_name']) ? 'datatable-cell-sorted' : null }}"
                >Student</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse ($students as $student)
                    <x-table.row>
                        <x-table.cell hasSymbol>
                            <span style="width:350px">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 symbol symbol-40 symbol-light-primary">
                                        <span class="symbol-label font-size-h4 font-weight-bold">{{ $student->first_name_initial }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="mb-0 text-dark-75 font-weight-bolder font-size-lg">{{ $student->full_name_listing }}</div>
                                        <a class="text-muted font-weight-bold text-hover-primary" href="#">{{ $student->email }}</a>
                                    </div>
                                </div>
                            </span>
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell>No students found for course section.</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <x-pagination :collection="$students" />
    </div>
</div>
