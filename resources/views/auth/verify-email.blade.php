<x-guest-layout>
    <!--begin::Verify Email Form-->
    <div class="w-100">

        <!--begin::Heading-->
        <div class="mb-10 text-center">
            <!--begin::Title-->
            <h1 class="mb-3 text-dark">
                {{ __('Verify Email') }}
            </h1>
            <!--end::Title-->

            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>
            <!--::Link-->

            <!--begin::Session Status-->
            @if (session('status') === 'verification-link-sent')
                <p class="mt-4 text-sm font-medium text-gray-500">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </p>
            @endif
            <!--end::Session Status-->
        </div>
        <!--begin::Heading-->

        <!--begin::Actions-->
        <div class="flex-wrap d-flex justify-content-center pb-lg-0">

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-lg btn-primary fw-bolder me-4">{{ __('Resend Verification Email') }}</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-lg btn-light-primary fw-bolder me-4">{{ __('Log out') }}</button>
            </form>
        </div>
        <!--end::Actions-->
    </div>

    <!--end::Verify Email Form-->
</x-guest-layout>
