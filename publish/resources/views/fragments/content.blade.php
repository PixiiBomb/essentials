@php
    /** * @var $page */
    use Illuminate\Support\Str;
    $showComments = config(WIDGET_INCLUDE_ALIAS_COMMENT);
    $sections = $page?->getSections();

    // @todo perhaps this becomes the component?
@endphp

@isset($sections)

    @foreach($sections as $index=>$section)

        @php
            $alias = $section->getAlias();
            $unique = is_null($alias)
                ? $index
                : $alias;
            $displayAlias = is_null($alias)
                ? '[NONE SET]'
                : $alias;
            $type = $section->getType();
            $displayType = Str::Studly($type);
            $asset = $section->getAsset();
            $name = is_null($asset->getName())
                ? '[UNKNOWN]'
                : $asset->getName();
            $filename = $asset->getFilename();
        @endphp

        <section id="Section-{{ $unique }}" data-index="{{ $index }}">

            @if($showComments)
                <!-- ({{$index}}) Type: {{$displayType}} | Name: {{ $name }} | Alias: {{ $displayAlias }} | Filename: {{ $filename }} -->
            @endif

            @switch($type)
                @case(WIDGET)
                    @include($filename, [WIDGET => $asset, INDEX => $index])
                    @break
                @case(VIEW)
                    @if(!is_null($section->getFilename()))
                        @include($section->getFilename())
                    @endif
                    @break
            @endswitch
        </section>

    @endforeach
@else
    <div>
        <kbd>/resources/views/fragments/content.blade.php</kbd>
        Unable to display the sections on this page.
    </div>
@endisset
