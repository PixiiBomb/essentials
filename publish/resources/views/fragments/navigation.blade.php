@php
    /** * @var $page */
    $navigation = $page?->getNavigation();
    $view = $navigation?->getView();
@endphp

@if(!isset($page))
    <x-debug>
        The $page object is missing.
    </x-debug>
@endisset

@isset($view)
    @include($view)
@else
    <x-debug>
        <kbd>Navigation</kbd>
        <pre>{{ var_dump($navigation) }}</pre>
    </x-debug>
@endisset
