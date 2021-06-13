<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Teach Me | Keenthemes</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css">
</head>

<body>

    <!--begin::Authentication-->
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-image: url({{ asset('media/illustrations/progress-hd.png') }})">

        <!--begin::Content-->
        <div class="p-10 d-flex flex-center flex-column flex-column-fluid pb-lg-20">

            <!--begin::Wrapper-->
            <div class="p-10 mx-auto bg-white rounded shadow-sm w-lg-500px p-lg-15">
                {{ $slot }}
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication-->
</body>
</html>
