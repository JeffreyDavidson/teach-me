<x-app-layout>
    <x-slot name="subheader">
        <x-subheader title="Semesters">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Academics" />
                    <x-breadcrumb-item label="Semesters" />
                    <x-breadcrumb-item label="Edit {{ $semester->name }}" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

     <!--begin::Card-->
     <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Edit Semester Form</h3>
            </div>
        </div>
        <!--end::Header-->
        <form method="post" action="{{ route('semesters.update', [$semester]) }}">
            @csrf
            @method('PUT')
            <!--begin::Body-->
            <div class="card-body">
                @include('semesters.partials.form', [
                    'terms' => App\Models\Term::allForDropdown(),
                    'years' => ['Please Choose A Year'] + array_combine($years = range(now()->year, now()->year + 5), $years)
                ])
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary font-weight-bold" {{ $semester->exists && $semester->start_date->isPast() ? 'disabled' : '' }}>Submit</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
            <!--end::Footer-->
        </form>
    </div>
    <!--end::Card-->
</x-app-layout>
