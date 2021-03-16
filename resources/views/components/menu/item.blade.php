<li class="menu-item @if ($isActive) menu-item-active @endif" aria-haspopup="true">
    <a href="{{ $route }}" class="menu-link">
        <span class="svg-icon menu-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
            {{ $slot }}
        </span>
        <span class="menu-text">{{ $text }}</span>
    </a>
</li>
