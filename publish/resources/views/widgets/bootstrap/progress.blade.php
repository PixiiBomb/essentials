@php
    /**
     * Vendor: pixiibomb/essentials
     * Controller: PixiiBomb\Essentials\Widgets\Progress
     * @var $widget
     */

    if(!isset($widget))
        return;

    $value = $widget->getValue();
@endphp

<div class="progress">
    <div class="progress-bar progress-bar-striped progress-bar-animated"
         role="progressbar"
         aria-valuenow="{{ $value }}}" aria-valuemin="0" aria-valuemax="100"
         style="width: {{ $value }}%">
    </div>
</div>
