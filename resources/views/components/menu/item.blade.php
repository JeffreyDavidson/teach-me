<div class="menu-item">
    <a href="{{ $route }}" class="menu-link @if ($isActive) active @endif">
        <span class="menu-icon">
            {{ $slot }}
        </span>
        <span class="menu-title">{{ $text }}</span>
    </a>
</div>
