<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Courses">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Academics" />
                    <x-breadcrumb-item label="Courses" />
                    <x-breadcrumb-item label="{{ $course->name }}" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>
    <div class="d-flex flex-row">
        <div id="kt_profile_aside" class="flex-row-auto offcanvas-mobile w-300px w-xl-350px">
            <div class="card card-custom">
                <div class="card-body pt-15">
                    <h5 class="font-weight-bold text-dark-75">{{ $course->name }}</h5>
                </div>
            </div>
        </div>
        <div class="flex-row-fluid ml-lg-8">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Course Sections List</h3>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin: Datatable-->
                    <livewire:course-sections-list :course="$course"/>
                    <!--end: Datatable-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
    </div>
</x-layout>
