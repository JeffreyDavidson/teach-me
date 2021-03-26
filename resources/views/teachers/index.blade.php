<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Teachers">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Administration" />
                    <x-breadcrumb-item label="Teachers" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Teacher List
            </div>
            <div class="card-toolbar">
                <a class="btn btn-primary font-weight-bolder" href="{{ route('teachers.create') }}">New Record</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body">
            <!--begin: Datatable-->
            <livewire:teachers-list />
            <!--end: Datatable-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card-->
</x-layout>
