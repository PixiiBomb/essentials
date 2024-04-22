@php
    /** * @var $page */
    $containers = $page?->getContainers();
@endphp

@isset($containers)
    @foreach($containers as $container)
        <x-container :details="$container" :errors="$errors"/>
    @endforeach
@else
    <x-debug>
        <kbd>fragments\content.blade.php</kbd>
        <pre>{{ var_dump($page) }}</pre>
    </x-debug>
@endisset
