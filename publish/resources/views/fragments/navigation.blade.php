@php
    /** * @var $page */
    $navigation = $page?->getNavigation();
    $view = $navigation?->getView();
@endphp

@isset($view)
    @include($view)
@else
    <x-debug>
        <div class="alert alert-danger">
            <kbd>Navigation Fragment</kbd><br><br>
            <i class="bi bi-file-earmark-post"></i> <strong>/resources/views/fragments/navigation.blade.php</strong><br>
            <i class="bi bi-bug-fill"></i> This fragment requires a <strong>$page->getNavigation()</strong> and <strong>$page->getNavigation()->getView()</strong>.
        </div>

        <div class="alert alert-primary">
            <kbd>$page->getNavigation()</kbd><br><br>
            <pre>{{ var_dump($navigation) }}</pre>
        </div>
    </x-debug>
@endisset
