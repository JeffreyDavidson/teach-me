<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Courses">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Academics" />
                    <x-breadcrumb-item label="Courses" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <x-card title="Course List">
        <x-slot name="toolbar">
            <a class="btn btn-primary font-weight-bolder" href="{{ route('courses.create') }}">New Record</a>
        </x-slot>

        <livewire:courses-list />
    </x-card>
</x-layout>
