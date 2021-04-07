<div>
    <div class="mb-7">
        <div class="row align-items-center">
            <x-search />
        </div>
    </div>

    <div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded">
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable wire:click="sortBy('name')"
                    :direction="$sorts['name'] ?? null"
                    class="{{ isset($sorts['name']) ? 'datatable-cell-sorted' : null }}"
                >Name</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('start_date')"
                    :direction="$sorts['start_date'] ?? null"
                    class="{{ isset($sorts['start_date']) ? 'datatable-cell-sorted' : null }}"
                >Start Date</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('end_date')"
                    :direction="$sorts['end_date'] ?? null"
                    class="{{ isset($sorts['end_date']) ? 'datatable-cell-sorted' : null }}"
                >End Date</x-table.heading>
                <x-table.heading>Courses</x-table.heading>
                <x-table.heading>Actions</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse ($semesters as $semester)
                    <x-table.row>
                        <x-table.cell>
                            <span style="width: 137px;">{{ $semester->name }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $semester->start_date }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <span style="width: 137px;">{{ $semester->end_date }}</span>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{ route('semesters.courses.index', $semester) }}">View</a>
                        </x-table.cell>

                        <x-table.cell>

                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell>No semesters found.</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <x-pagination :collection="$semesters" />
    </div>
</div>
