@php
    /**
     * @var $data
     */
    if(!isset($data)) { return; }
@endphp

@if(!empty($data->getFilename()))
    <div class="{{ $data->getIsFluid() }}">
        @include($data->getFilename(), [CONTAINER_DATA => $data->getContainerData(), ERRORS => $errors])
    </div>
@endif

@if(!is_null($data->getComponent()))
    <div class="{{ $data->getIsFluid() }}">
        <x-dynamic-component :component="$data->getComponent()->componentName" :data="$data->getComponent()"></x-dynamic-component>
    </div>
@endif
