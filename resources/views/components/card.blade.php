@props(['title' => '', 'toolbar' => '', 'bodyClasses' => '', 'headless' => false, 'hasFooter' => false])

<!--begin::Card-->
<div class="card card-custom">
    @unless ($headless)
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
    @endunless

    <!--begin::Body-->
    <div class="card-body {{ $bodyClasses }}">
        {{ $slot }}
    </div>
    <!--end::Body-->

    @if ($hasFooter)
        <!--begin::Footer-->
        <div class="card-footer">
            {{ $footer }}
        </div>
        <!--end::Footer-->
    @endif
</div>
<!--end::Card-->
