<!--begin::Card-->
<div class="card card-custom">
    <!--begin::Header-->
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">{{ $title }}</h3>
        </div>
        <div class="card-toolbar">
            {{ $toolbar }}
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        {{ $slot }}
    </div>
    <!--end::Body-->
</div>
<!--end::Card-->
