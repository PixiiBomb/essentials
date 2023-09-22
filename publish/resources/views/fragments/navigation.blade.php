@php
    /** * @var $content */
    if(!isset($content)) { return; }

    $navigation = $content->getNavigation();
    $view = $navigation?->getView();
@endphp

@isset($view)
    @include($content->getNavigation()->getView())
@else
    <x-debug>
        <kbd>Navigation</kbd>
        <pre>{{ var_dump($navigation) }}</pre>
    </x-debug>
@endisset
