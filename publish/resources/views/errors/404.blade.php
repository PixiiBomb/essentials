@php
    $route = \Illuminate\Support\Facades\Route::getCurrentRoute();
@endphp

<h2><kbd>DEBUG</kbd> ERROR 404</h2>
<p>You will typically encounter this page when attempting to embed a view:</p>

@isset($route)
    <div class="card">
        <div class="card-header">Retrace Your Steps</div>
        <div class="card-body">
            <ul>
                <li>URL: {{ $route->uri() }}</li>
                <li>Controller: {{ $route->getControllerClass() }}</li>
                <li>Method: {{ $route->getActionMethod() }}</li>
            </ul>
        </div>
    </div>
@endif

@isset($details)
    <div class="card mt-4">
        <div class="card-header"><strong>$details</strong></div>
        <div class="card-body">
            <p>The <code>$details</code> objects is associated with PixiiComponents. If you're seeing this message, it's because you're attempting to create a <code>PixiiComponent</code>, and you've successfully received a $details object, but you may have some invalid values.</p>

            @if(!is_null($details->getAttemptedView()))
                <p>It seems as if you were attempting to set the view <kbd>{{ $details->getAttemptedView() }}</kbd> but that file path doesn't seem to exist in <strong>/resources/views/</strong>.</p>
            @endif
            @dump($details)
        </div>
    </div>
@endisset

<hr>
