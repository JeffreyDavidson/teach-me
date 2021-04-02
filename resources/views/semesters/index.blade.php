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

    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Semester List
            </div>
            <div class="card-toolbar">
                <a class="btn btn-primary font-weight-bolder" href="{{ route('semesters.create') }}">New Record</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body">
            <!--begin: Datatable-->
            <livewire:semesters-list />
            <!--end: Datatable-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card-->
</x-layout>
