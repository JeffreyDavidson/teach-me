@props([
    'sortable' => null,
    'direction' => null,
])

@if ($sortable)
<th
    {{ $attributes->merge(['class' => 'datatable-cell datatable-cell-sort'])->only('class') }}
>
@else
<th
    {{ $attributes->merge(['class' => 'datatable-cell'])->only('class') }}
>
@endif
    @unless ($sortable)
        <span style="width: 130px">{{ $slot }}</span>
    @else
        <span {{ $attributes->except('class') }}>
            {{ $slot }}
            @if ($direction === 'asc')
                <i class="flaticon2-arrow-up"></i>
            @elseif ($direction === 'desc')
                <i class="flaticon2-arrow-down"></i>
            @endif
        </span>
    @endif
</th>
