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
            <div class="card card-custom">
                <div class="card-body pt-15">
                    <h5 class="font-weight-bold text-dark-75">{{ $section->teacher->name }}</h5>
                    <h6 class="font-weight-bold text-dark-75">{{ $section->day }}</h6>
                    <div class="text-muted">{{ $section->start_time }} to {{ $section->end_time }}</div>
                </div>
            </div>
        </div>
        <div class="flex-row-fluid ml-lg-8">

        </div>
    </div>
</x-layout>
