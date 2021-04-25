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
                    <x-breadcrumb-item label="{{ $section->name }}" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <div class="d-flex flex-row">
        <div id="kt_profile_aside" class="flex-row-auto offcanvas-mobile w-300px w-xl-350px">
            <x-card headless bodyClasses="pt-8">
                <h5 class="font-weight-bold text-dark-75">{{ $section->teacher->name }}</h5>
                <h6 class="font-weight-bold text-dark-75">{{ $section->day }}</h6>
                <div class="text-muted">{{ $section->start_time }} to {{ $section->end_time }}</div>
            </x-card>
        </div>
        <div class="flex-row-fluid ml-lg-8">
            <x-card title="Course Section Student List">
                <livewire:semester-course-section-student-list :courseSection="$section" :semester="$semester" />
            </x-card>
        </div>
    </div>
</x-layout>
