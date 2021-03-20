<x-layout>
    <x-slot name="subheader">
        <x-subheader title="Teachers">
            <x-slot name="breadcrumb">
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Administration</a></li>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">Teachers</a></li>
                    <li class="breadcrumb-item"><a class="text-muted" href="#">{{ $teacher->full_name }}</a></li>
                </x-breadcrumb>
            </x-slot>
        </x-subheader>
    </x-slot>
    <div class="d-flex flex-row">
        <div id="kt_profile_aside" class="flex-row-auto offcanvas-mobile w-300px w-xl-350px">
            <div class="card card-custom">
                <div class="card-body pt-15">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                            <div class="symbol-label" style="background-image:url('/metronic/theme/html/demo1/dist/assets/media/users/300_13.jpg')"></div>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark-75">{{ $teacher->full_name }}</h5>
                            <div class="text-muted">Teacher</div>
                        </div>
                    </div>
                    <div class="pt-8 pb-6">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Email:</span>
                            <a href="#" class="text-muted text-hover-primary">{{ $teacher->email }}</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">School Email:</span>
                            <a href="#" class="text-muted text-hover-primary">{{ $teacher->school_email }}</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Phone:</span>
                            <span class="text-muted">{{ $teacher->formatted_phone }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="font-weight-bold mr-2">Location:</span>
                            <div>
                                <span class="text-muted">
                                    {{ $teacher->address->street }}<br>
                                    {{ $teacher->address->city }}, {{ $teacher->address->state }} {{ $teacher->address->zip }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-row-fluid ml-lg-8">

        </div>
    </div>
</x-layout>
