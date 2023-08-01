@php
    /**
     * @var $data
     */
    if(!isset($data)) { return; }
@endphp

<div class="accordion" id="{{ $data->id() }}">
    <div class="accordion-item">

        @if(!empty($data->getItems()))
            <?php
                $i = 0;
            ?>
            @foreach($data->getItems() as $item)
                <?php
                    $id = $data->id(false, $i);
                ?>
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{$id}}" aria-expanded="true" aria-controls="{{$id}}">
                        {{ $item->getHeader() ?? 'Accordion Header' }}
                    </button>
                </h2>
                <div id="{{$id}}" class="accordion-collapse collapse {{ in_array($i, $data->getShowIndexes()) ? 'show' : null }}" data-bs-parent="{{ $data->id(true) }}">
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
