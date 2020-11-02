<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Teach Me</title>
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <link rel="stylesheet" href="{{ asset('css/style.bundle.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/themes/layout/header/base/light.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/themes/layout/header/menu/light.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/themes/layout/brand/dark.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/themes/layout/aside/dark.css') }}" />
    </head>
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable">
        <!--begin::Main-->
            <!--begin::Header Mobile-->
            <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
                <!--begin::Logo-->
                <a href="index.html">
                    <h1>{{ config('app.name') }}</h1>
                </a>
                <!--end::Logo-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Aside Mobile Toggle-->
                    <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                        <span></span>
                    </button>
                    <!--end::Aside Mobile Toggle-->
                    <!--begin::Header Menu Mobile Toggle-->
                    <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                        <span></span>
                    </button>
                    <!--end::Header Menu Mobile Toggle-->
                    <!--begin::Topbar Mobile Toggle-->
                    <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                        <span class="svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </button>
                    <!--end::Topbar Mobile Toggle-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header Mobile-->
            <div class="d-flex flex-column">
                <!--begin::Page-->
                <div class="d-flex flex-row flex-column-fluid page">
                    <x-sidebar />
                    <!--begin::Wrapper-->
                    <div id="kt_wrapper" class="d-flex flex-column flex-row-fluid wrapper">
                        <x-header />
                        <!--begin::Content-->
                        <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
                            <!--begin::Subheader-->
                            {{ $subheader }}
                            <!--end::Subheader-->
                            <!--begin::Entry-->
                            <div class="d-flex flex-column-fluid">
                                <!--begin::Container-->
                                <div class="container-fluid">
                                    {{ $slot }}
                                </div>
                                <!--end::Container-->
                            </div>
                            <!--end::Entry-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Page-->
            </div>
        <!--end::Main-->
    </body>
    <!--end::Body-->
</html>
