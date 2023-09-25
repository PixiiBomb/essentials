@php
    /** * @var $page */
    $breadcrumbs = $page?->getBreadcrumbs();
@endphp

@if(!isset($page))
    <x-debug>
        The $page object is missing.
    </x-debug>
@endisset

@isset($breadcrumbs)
    <x-pixii::breadcrumbs :details="$breadcrumbs"/>
@else
    <x-debug>
        <kbd>Breadcrumbs</kbd>
        <pre>{{ var_dump($breadcrumbs) }}</pre>
    </x-debug>
@endisset
