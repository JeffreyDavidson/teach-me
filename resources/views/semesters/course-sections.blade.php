<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Course Sections">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Academics" />
                    <x-breadcrumb-item label="Semesters" />
                    <x-breadcrumb-item label="{{ $semester->name }}" />
                    <x-breadcrumb-item label="Course" />
                    <x-breadcrumb-item label="{{ $course->name }}" />
                    <x-breadcrumb-item label="Course Sections" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <x-card title="Course Sections List">
        <livewire:semester-course-sections-list :semester="$semester" :course="$course" />
    </x-card>
</x-layout>
