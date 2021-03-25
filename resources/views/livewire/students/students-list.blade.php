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
                @forelse ($students as $student)
                    <x-table.row>
                        <x-table.cell hasSymbol>
                            <span style="width:250px">
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

                        <x-table.cell>
                            <span style="width: 137px;">{{ $student->school_email }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $student->formatted_phone }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="View details">
                                <span class="svg-icon svg-icon-md">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                                <span class="svg-icon svg-icon-md">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "></path>
                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"></rect>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell>No students found</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <div class="datatable-pager datatable-paging-loaded">
            {{ $students->links() }}
            <div class="datatable-pager-info my-2 mb-sm-0">
                <select wire:model="perPage" class="datatable-pager-size">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                </select>
                <span class="datatable-pager-detail">Showing {{ $students->firstItem() }} - {{ $students->lastItem() }} of {{ $students->total() }}</span>
            </div>
        </div>
    </div>
</div>
