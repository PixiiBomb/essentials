@php
    /** * @var $data */
    if(!isset($data)) { return; }
    if(!$data->getShowBreadcrumbs()) { return; }
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route(HOME) }}">Home</a></li>

        @if(!empty($data->getBreadcrumbs()))
            @foreach($data->getBreadcrumbs() as $breadcrumb)
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
