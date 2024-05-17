@php
    /** * @var $page */
    $sections = $page?->getSections();
@endphp

@isset($sections)
    @foreach($sections as $key=>$section)

        <h1>{{ $key }}</h1>
        @php
            $alias = $section->getAlias();
            $idTag = (!empty($alias))
                    ? " id=Section-{$alias}"
                    : null;
        @endphp

        <section{{ $idTag }}>
            @php
                $type = $section->getType();
                $asset = $section->getAsset();
            @endphp

            @switch($type)
                @case(WIDGET)
                    <x-ui :widget="$asset" :key="$key"></x-ui>
                @case(VIEW)
                    @if(!is_null($section->getFilename()))
                        @include($section->getFilename())
                    @endif
            @endswitch
        </section>

    @endforeach
@else
    <div>
        <kbd>/resources/views/fragments/content.blade.php</kbd>
        Unable to display the sections on this page.
    </div>
@endisset

