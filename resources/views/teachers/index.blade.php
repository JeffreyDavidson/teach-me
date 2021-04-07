<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Teachers">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Administration" />
                    <x-breadcrumb-item label="Teachers" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <x-card title="Teacher List">
        <x-slot name="toolbar">
            <a class="btn btn-primary font-weight-bolder" href="{{ route('teachers.create') }}">New Record</a>
        </x-slot>
        <livewire:teachers-list />
    </x-card>
</x-layout>
