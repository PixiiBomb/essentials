@php
    /**
     * Vendor: pixiibomb/essentials
     * Controller: PixiiBomb\Essentials\Widgets\Accordion
     * @var $widget
     */

    if(!isset($widget))
        return;
@endphp

<div class="accordion">
    <div class="accordion-item">

        @if(!empty($widget->getItems()))

            @foreach($widget->getItems() as $i=>$item)

                @php $id = $widget->id(false, $i); @endphp

                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{$id}}" aria-expanded="true" aria-controls="{{$id}}">
                        {{ $item->getHeader() ?? 'Accordion Header' }}
                    </button>
                </h2>
                <div id="{{$id}}" class="accordion-collapse collapse {{ in_array($i, $widget->getActiveIndexes()) ? 'show' : null }}" data-bs-parent="{{ $widget->id(true) }}">
                    <div class="accordion-body">
                        {{ $item->getBody() ?? 'Accordion Body' }}
                    </div>
                </div>

            @endforeach
        @endif

    </div>
</div>

