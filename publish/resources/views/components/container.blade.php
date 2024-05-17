@php
    /**
     * @var $details
     */

    if(!isset($details))
        return;

    $id = $details->id();
@endphp

@if($details->isInvalid())
    <x-debug>
        <div class="alert alert-primary">
            <div class="alert alert-danger">
                <kbd>Unable to render Container component</kbd><br>
                The file where this error is coming from: <strong>/resources/views/components/container.blade.php</strong><br>
                You are seeing this message because you are attempting to use the Container component, but you "have nothing to contain". A Container should have a least a View, a Component, or both.
            </div>

            <kbd>Container $details</kbd>
            <pre>{{ print_r($details) }}</pre>
        </div>
    </x-debug>
    @php return; @endphp
@endif

{{ $details->getComment(true) }}
<div class="{{ $details->getIsFluid() }}"{{ $details->getIdTag() }}>

    @if(!empty($details->getView()))
        @include($details->getView(), [DETAILS => $details, ERRORS => $errors])
    @endif

    @if(!empty($details->getComponent()))
        <x-dynamic-component :component="$details->getComponent()->componentName" :details="$details->getComponent()"></x-dynamic-component>
    @endif

</div>
{{ $details->getComment(false) }}
