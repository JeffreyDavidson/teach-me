<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Students">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Administration" />
                    <x-breadcrumb-item label="Students" />
                    <x-breadcrumb-item label="Edit {{ $student->name }}" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <form method="post" action="{{ route('students.update', $student) }}">
        @csrf
        @method('PATCH')
        <x-card hasFooter title="Edit Student Form">
            @include('students.partials.form')
            <x-slot name="footer">
                <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </x-slot>
        </x-card>
    </form>
</x-layout>
