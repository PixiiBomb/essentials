@php
    /**
     * Vendor: pixiibomb/essentials
     * Controller: PixiiBomb\Essentials\Widgets\Carousel
     * @var $widget
     */
    if(!isset($widget))
        return;

    $id = $widget->id();
    $activeIndex = $widget->getActiveIndex();
@endphp

<div class="carousel slide" data-bs-ride="carousel" id="{{ $id }}">

    <div class="carousel-indicators">

        @if(!empty($widget->getItems()))
            @foreach($widget->getItems() as $i=>$item)

                @php
                    $isActive = ($i == $activeIndex);
                    $activeClass = $isActive ? 'active' : '';
                    $ariaCurrent = $isActive ? 'true' : 'false';
                @endphp

                <button type="button"
                        data-bs-target="#{{ $id }}"
                        data-bs-slide-to="{{ $i }}"
                        class="{{ $activeClass }}"
                        aria-current="{{ $ariaCurrent }}"
                        aria-label="Slide {{ $i+1 }}">
                </button>
            @endforeach
        @endif
    </div>

    @if(!empty($widget->getItems()))
        <div class="carousel-inner">
            @foreach($widget->getItems() as $i=>$item)
                @php
                    $active = $i == $activeIndex
                        ? ' active'
                        : null;
                @endphp
                <div class="carousel-item{{ $active }}">
                    @if(!empty($item->getType()))

                        @switch($item->getType())
                            @case(IMAGE)
                                <img src="{{ asset($item->getSource()) }}" class="d-block w-100" alt="{{ $item->getAlt() }}">
                        @endswitch
                    @endif
                    <div class="carousel-caption d-none d-md-block">
                        {{ $item->getCaption() }}
                    </div>
                </div>

            @endforeach
        </div>
    @endif

    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $id }}" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#{{ $id }}" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
