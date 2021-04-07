<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Semesters">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Academics" />
                    <x-breadcrumb-item label="Semesters" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <x-card title="Semester List">
        <livewire:semesters-list />
    </x-card>
</x-layout>
