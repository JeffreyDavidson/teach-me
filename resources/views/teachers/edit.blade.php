<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Teachers">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <x-breadcrumb-item label="Administration" />
                    <x-breadcrumb-item label="Teachers" />
                    <x-breadcrumb-item label="Edit {{ $teacher->name }}" />
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>

    <form method="post" action="{{ route('teachers.update', $teacher) }}">
        @csrf
        @method('PATCH')
        <x-card hasFooter title="Edit Teacher Form">
            @include('teachers.partials.form')
            <x-slot name="footer">
                <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </x-slot>
        </x-card>
    </form>
</x-layout>
