@php
    /**
     * @var $details
     */
    if(!isset($details)) { return; }
@endphp

@if(!empty($details->getFilename()))
    <div class="{{ $details->getIsFluid() }}">
        @include($details->getFilename(), [CONTAINER_DATA => $details->getContainerData(), ERRORS => $errors])
    </div>
@endif

@if(!is_null($details->getComponent()))
    <div class="{{ $details->getIsFluid() }}">
        <x-dynamic-component :component="$details->getComponent()->componentName" :data="$details->getComponent()"></x-dynamic-component>
    </div>
@endif
