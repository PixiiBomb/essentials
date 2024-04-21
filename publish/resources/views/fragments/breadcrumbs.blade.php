@php
    /** * @var $page */
    $breadcrumbs = $page?->getBreadcrumbs();
@endphp

@isset($breadcrumbs)
    <x-breadcrumbs :details="$breadcrumbs"/>
@else
    <x-debug>
        <kbd>Breadcrumbs</kbd>
        <pre>{{ var_dump($breadcrumbs) }}</pre>
    </x-debug>
@endisset
