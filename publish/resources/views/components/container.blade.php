@php
    /**
     * @var $details
     */
    if(!isset($details)) { return; }
@endphp

@if(!empty($details->getView()))
    <div class="{{ $details->getIsFluid() }}" id="{{ $details->id() }}">
        @include($details->getView(), [DETAILS => $details, ERRORS => $errors])
    </div>
@endif

@if(!is_null($details->getComponent()))
    <div class="{{ $details->getIsFluid() }}">
        <x-dynamic-component :component="$details->getComponent()->componentName" :data="$details->getComponent()"></x-dynamic-component>
    </div>
@endif
