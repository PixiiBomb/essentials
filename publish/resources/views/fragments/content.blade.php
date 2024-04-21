@php
    /** * @var $page */
    $containers = $page?->getContainers();
@endphp

@if(!isset($page))
    <x-debug>
        The $page object is missing.
    </x-debug>
@endisset

@isset($containers)
    @foreach($containers as $container)
        <x-container :details="$container" :errors="$errors"/>
    @endforeach
@else
    <x-debug>
        <kbd>fragments\page.blade.php</kbd>
        <pre>{{ var_dump($page) }}</pre>
    </x-debug>
@endisset
