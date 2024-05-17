@php
    /**
     * @var $widget
     */

    $showComments = config(WIDGET_INCLUDE_ALIAS_COMMENT);

    $id = $widget->id();
    $idTag = (!empty($widget->getAlias()))
            ? " id={$id}"
            : null;
    $filename = $widget->getFilename();
    $formatFilename = str_replace('.', '/', $widget->getAttemptedFilename());

@endphp

<div data-widget="{{ $widget->getName() }}"{{ $idTag }}>

    @if($showComments)<!-- Widget: {{ $id }} -->@endif

    @isset($filename)

        @if($filename == E404)
            @debug
            <div class="alert alert-danger">
                <kbd>{{ E404 }}</kbd>
                <p>
                    A Widget at path /resources/views/<strong>{{ $formatFilename }}</strong>.blade.php does not exist
                </p>
                <p>
                    <strong>Active Widget Theme:</strong> {{ config(WIDGET_ACTIVE_THEME, 'Not Configured') }}<br>
                    The active widget theme can be configured in <code>/config/pixii.php</code> by changing the value of
                    <code>['widgets']['active_theme']</code> to the name of a subfolder within the <code>/resources/views/widgets</code> directory. If this file does not exist in your project, you may need to publish the PixiiBomb/Essentials vendor files by running the command <code>php artisan vendor:publish --provider="PixiiBomb\Essentials\PixiiBombEssentialsServiceProvider"</code>
                </p>
                <strong>Widget Information:</strong><br>
                <ul>
                    <li>Key: <strong>{{ $widget->getKey() }}</strong></li>
                    <li>Widget: <strong>{{ $widget->getName() }}</strong></li>
                    <li>Structure: <strong>{{ $widget->getStructure() }}</strong></li>
                </ul>
            </div>
            @enddebug
        @else
            @include($filename, [WIDGET => $widget])
        @endif
    @endisset

    @if($showComments)<!-- /: {{ $id }} -->@endif

</div>
