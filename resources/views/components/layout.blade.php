<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Teach Me</title>
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <link rel="stylesheet" href="{{ asset('plugins/global/plugins.bundle.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.bundle.css') }}" />
        @livewireStyles
    </head>
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable">
        <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="flex-row page d-flex flex-column-fluid">
                <x-sidebar />
                <!--begin::Wrapper-->
                <div id="kt_wrapper" class="d-flex flex-column flex-row-fluid wrapper">
                    <x-header />
                    <!--begin::Content-->
                    <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <x-toolbar />
                        <!--end::Toolbar-->

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
        <!--end::Root-->
        <!--end::Main-->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('js/scripts.bundle.js') }}"></script>
        @livewireScripts
        @stack('scripts')
    </body>
    <!--end::Body-->
</html>
