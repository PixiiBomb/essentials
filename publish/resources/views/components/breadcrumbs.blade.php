@php
    /** * @var $details */
    if(!isset($details)) { return; }
    if(!$details->getShowBreadcrumbs()) { return; }
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route(HOME) }}">Home</a></li>

        @if(!empty($details->getBreadcrumbs()))
            @foreach($details->getBreadcrumbs() as $breadcrumb)
                @if($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->getLabel() }}</li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb->getHref() }}">
                            {{ $breadcrumb->getLabel() }}
                        </a>
                    </li>
                @endif
            @endforeach
        @endif
    </ol>
</nav>
