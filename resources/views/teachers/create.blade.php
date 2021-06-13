<x-app-layout>
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

    <form method="post" action="{{ route('teachers.store') }}">
        @csrf
        <x-card hasFooter title="Hire Teacher Form">
            @include('teachers.partials.form')
            <x-slot name="footer">
                <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </x-slot>
        </x-card>
    </form>
</x-app-layout>
