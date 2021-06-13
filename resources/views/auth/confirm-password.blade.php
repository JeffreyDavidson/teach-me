<x-guest-layout>

    <!--begin::Forgot Password Form-->
    <form method="POST" action="{{ route('password.confirm') }}">
    @csrf

        <!--begin::Heading-->
        <div class="mb-10 text-center">
            <!--begin::Title-->
            <h1 class="mb-3 text-dark">
                {{ __('Confirm Password') }}
            </h1>
            <!--end::Title-->

            <!--begin::Link-->
            <div class="mb-4 text-sm text-gray-600">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>
            <!--end::Link-->
        </div>
        <!--begin::Heading-->

        <!--begin::Input group-->
        <div class="mb-10 fv-row">
            <label class="text-gray-900 form-label fw-bolder fs-6">{{ __('Password') }}</label>
            <input class="form-control form-control-solid" type="password" name="password" autocomplete="current-password" required autofocus/>
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="flex-wrap d-flex justify-content-center pb-lg-0">
            <button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder me-4">
                @include('partials.general._button-indicator')
            </button>

            <a href="{{ route('login') }}" class="btn btn-lg btn-light-primary fw-bolder">{{ __('Cancel') }}</a>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Forgot Password Form-->

</x-guest-layout>
