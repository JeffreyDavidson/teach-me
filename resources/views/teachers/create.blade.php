<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Teachers">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Administration" />
                    <x-breadcrumb-item label="Teachers" />
                    <x-breadcrumb-item label="Add New" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Hire Teacher Form
            </div>
        </div>
        <!--end::Header-->
        <form method="post" action="{{ route('teachers.store') }}">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                @include('teachers.partials.form')
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
