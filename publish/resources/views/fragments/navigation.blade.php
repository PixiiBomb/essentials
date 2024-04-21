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
            <i class="bi bi-bug-fill"></i> This fragment requires a <strong>$navigation</strong> and <strong>$view</strong> object.
        </div>

        <div class="alert alert-primary">
            <kbd>$navigation</kbd><br><br>
            <pre>{{ var_dump($navigation) }}</pre>
        </div>

        <div class="alert alert-primary">
            <kbd>$view</kbd><br><br>
            <pre>{{ var_dump($view) }}</pre>
        </div>
    </x-debug>
@endisset
