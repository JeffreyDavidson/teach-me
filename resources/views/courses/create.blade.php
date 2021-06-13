<x-app-layout>
    <x-slot name="subheader">
        <x-subheader title="Courses">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Academics" />
                    <x-breadcrumb-item label="Courses" />
                    <x-breadcrumb-item label="Add" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <form method="post" action="{{ route('courses.store') }}">
        @csrf
        <x-card hasFooter title="Add Course Form">
            @include('courses.partials.form')
            <x-slot name="footer">
                <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </x-slot>
        </x-card>
    </form>
</x-app-layout>
