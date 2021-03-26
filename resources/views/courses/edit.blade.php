<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Courses">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Academics</a></li>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Courses</a></li>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Edit {{ $course->name }}</a></li>
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Edit Course Form
            </div>
        </div>
        <!--end::Header-->
        <form method="post" action="{{ route('courses.update', $course) }}">
            @csrf
            @method('PATCH')
            <!--begin::Body-->
            <div class="card-body">
                @include('courses.partials.form')
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
            <!--end::Footer-->
        </form>
    </div>
    <!--end::Card-->
</x-layout>
