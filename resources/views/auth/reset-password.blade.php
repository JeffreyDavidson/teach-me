<x-guest-layout>

    <!--begin::Reset Password Form-->
    <form method="POST" action="{{ route('password.update') }}" class="form w-100" novalidate="novalidate" id="kt_new_password_form">
    @csrf

    <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!--begin::Heading-->
        <div class="mb-10 text-center">
            <!--begin::Title-->
            <h1 class="mb-3 text-dark">
                {{ __('Update Your Password') }}
            </h1>
            <!--end::Title-->

            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>
            <!--end::Link-->
        </div>
        <!--begin::Heading-->

        <!--begin::Input group-->
        <div class="mb-10 fv-row">
            <label class="text-gray-900 form-label fw-bolder fs-6">{{ __('Email') }}</label>
            <input class="form-control form-control-solid" type="email" name="email" autocomplete="off" value="{{ old('email', $request->email) }}" required/>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="mb-10 fv-row" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6">
                    {{ __('Password') }}
                </label>
                <!--end::Label-->

                <!--begin::Input wrapper-->
                <div class="mb-3 position-relative">
                    <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="new-password"/>

                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
                </div>
                <!--end::Input wrapper-->

                <!--begin::Meter-->
                <div class="mb-3 d-flex align-items-center" data-kt-password-meter-control="highlight">
                    <div class="rounded flex-grow-1 bg-secondary bg-active-success h-5px me-2"></div>
                    <div class="rounded flex-grow-1 bg-secondary bg-active-success h-5px me-2"></div>
                    <div class="rounded flex-grow-1 bg-secondary bg-active-success h-5px me-2"></div>
                    <div class="rounded flex-grow-1 bg-secondary bg-active-success h-5px"></div>
                </div>
                <!--end::Meter-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Hint-->
            <div class="text-muted">
                {{ __('Use 8 or more characters with a mix of letters, numbers & symbols.') }}
            </div>
            <!--end::Hint-->
        </div>
        <!--end::Input group--->

        <!--begin::Input group-->
        <div class="mb-10 fv-row">
            <label class="text-gray-900 form-label fw-bolder fs-6">{{ __('Confirm Password') }}</label>
            <input class="form-control form-control-solid" type="password" name="password_confirmation" autocomplete="off" required/>
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="flex-wrap d-flex justify-content-center pb-lg-0">
            <button type="submit" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bolder me-4">
                @include('partials.general._button-indicator')
            </button>

            <a href="{{ route('login') }}" class="btn btn-lg btn-light-primary fw-bolder">{{ __('Cancel') }}</a>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Reset Password Form-->

    @section('scripts')
        <script src="{{ asset('js/custom/authentication/password-reset/new-password.js') }}" type="application/javascript"></script>
    @endsection

</x-guest-layout>
