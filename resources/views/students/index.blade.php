<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Students">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Administration</a></li>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Students</a></li>
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Student List
            </div>
            <div class="card-toolbar">
                <a class="btn btn-primary font-weight-bolder" href="{{ route('students.create') }}">New Record</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body">
            <!--begin: Datatable-->
            <livewire:students-list />
            <!--end: Datatable-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card-->
</x-layout>
