<x-app-layout>
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
            <x-card headless bodyClasses="pt-8">
                <h5 class="font-weight-bold text-dark-75">{{ $course->name }}</h5>
            </x-card>
        </div>
        <div class="flex-row-fluid ml-lg-8">

        </div>
    </div>
</x-app-layout>
