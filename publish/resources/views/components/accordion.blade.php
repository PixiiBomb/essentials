@php
    /**
     * @var $details
     */
    if(!isset($details)) { return; }
@endphp

<div class="accordion" id="{{ $details->id() }}">
    <div class="accordion-item">

        @if(!empty($details->getItems()))
            <?php
                $i = 0;
            ?>
            @foreach($details->getItems() as $item)
                <?php
                    $id = $details->id(false, $i);
                ?>
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{$id}}" aria-expanded="true" aria-controls="{{$id}}">
                        {{ $item->getHeader() ?? 'Accordion Header' }}
                    </button>
                </h2>
                <div id="{{$id}}" class="accordion-collapse collapse {{ in_array($i, $details->getShowIndexes()) ? 'show' : null }}" data-bs-parent="{{ $details->id(true) }}">
                    <div class="accordion-body">
                        {{ $item->getBody() ?? 'Accordion Body' }}
                    </div>
                </div>
                <?php
                    $i++;
                ?>
            @endforeach
        @endif


    </div>
</div>
