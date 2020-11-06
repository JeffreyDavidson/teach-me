<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Teachers">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Administration</a></li>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Teachers</a></li>
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="flex-wrap pt-6 pb-0 border-0 card-header">
            <div class="card-title">
                <h3 class="card-label">Teacher Management
            </div>
            <div class="card-toolbar">
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
