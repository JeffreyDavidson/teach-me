@props([
    'title' => '',
    'breadcrumb' => ''
])

<div id="kt_toolbar" class="py-2 subheader py-lg-6 subheader-solid">
    <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
        <!--begin::Info-->
        <div class="flex-wrap mr-1 d-flex align-items-center">
            <!--begin::Page Heading-->
            <div class="flex-wrap mr-5 d-flex align-items-baseline">
                <!--begin::Page Title-->
                <h5 class="my-1 mr-5 text-dark font-weight-bold">{{ $title }}</h5>
                <!--end::Page Title-->

                <!--begin::Breadcrumb-->
                {{ $breadcrumb }}
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
</div>
