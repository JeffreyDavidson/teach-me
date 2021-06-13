<x-app-layout>
    <x-slot name="subheader">
        <x-subheader title="Students">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Administration" />
                    <x-breadcrumb-item label="Students" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <x-card title="Student List">
        <x-slot name="toolbar">
            <a class="btn btn-primary font-weight-bolder" href="{{ route('students.create') }}">New Record</a>
        </x-slot>
        <livewire:students-list />
    </x-card>
</x-app-layout>
