<x-app-layout>
    <x-slot name="subheader">
        <x-subheader title="Courses">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Academics" />
                    <x-breadcrumb-item label="Courses" />
                    <x-breadcrumb-item label="Edit {{ $course->name }}" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <form method="post" action="{{ route('courses.update', $course) }}">
        @csrf
        @method('PATCH')
        <x-card hasFooter title="Edit Course Form">
            @include('courses.partials.form')
            <x-slot name="footer">
                <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </x-slot>
        </x-card>
    </form>
</x-app-layout>
