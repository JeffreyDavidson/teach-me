<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Courses">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Academics</a></li>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Courses</a></li>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">{{ $course->name }}</a></li>
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

        </div>
    </div>
</x-layout>
