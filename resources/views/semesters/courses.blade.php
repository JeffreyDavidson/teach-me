<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Courses">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Academics" />
                    <x-breadcrumb-item label="Semesters" />
                    <x-breadcrumb-item label="{{ $semester->name }}" />
                    <x-breadcrumb-item label="Courses" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <x-card title="Course List">
        <livewire:semester-course-list :semester="$semester" />
    </x-card>
</x-layout>
