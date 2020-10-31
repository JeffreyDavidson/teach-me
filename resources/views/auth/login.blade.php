<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Teach Me | Login</title>
        <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Page Custom Styles(used by this page)-->
        <link rel="stylesheet" href="{{ asset('css/pages/login.css') }}">
        <!--end::Page Custom Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Login-->
            <div class="bg-white login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid" id="kt_login">
                <!--begin::Content-->
                <div class="mx-auto overflow-hidden login-content flex-row-fluid d-flex flex-column justify-content-center position-relative p-7">
                    <!--begin::Content body-->
                    <div class="d-flex flex-column-fluid flex-center">
                        <!--begin::Signin-->
                        <div class="login-form login-signin">
                            <!--begin::Form-->
                            <form class="form" novalidate="novalidate" id="kt_login_signin_form" action="/login" method="post">
                                @csrf
                                <!--begin::Title-->
                                <div class="pt-5 pb-13 pt-lg-0">
                                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome to {{ config('app.name') }}</h3>
                                </div>
                                <!--end::Title-->
                                <!--begin::Form group-->
                                <x-text-input
                                    id="email"
                                    name="email"
                                    type="text"
                                    label="Email"
                                    :required="true"
                                    placeholder=""
                                    class="h-auto py-6 rounded-lg form-control-solid"
                                    value="{{ old('email') }}" />
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <x-text-input
                                    id="password"
                                    name="password"
                                    type="password"
                                    label="Password"
                                    :required="true"
                                    placeholder=""
                                    class="h-auto py-6 rounded-lg form-control-solid"
                                    value="{{ old('password') }}" />
                                <!--end::Form group-->
                                <!--begin::Action-->
                                <div class="pb-5 pb-lg-0">
                                    <button type="submit" id="kt_login_signin_submit" class="px-8 py-4 my-3 mr-3 btn btn-primary font-weight-bolder font-size-h6">Sign In</button>
                                </div>
                                <!--end::Action-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Signin-->
                    </div>
                    <!--end::Content body-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Login-->
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
