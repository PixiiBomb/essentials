@if(!isset($page))
    <x-debug>
        Unable to display app.blade.php - the <code>$page</code> object is not set.
    </x-debug>
@endisset

@php
    /** @var $page  */
    if($page == null) { return; }

    $meta = $page?->getMeta();
    $scripts = $page?->getScripts();
    $pageStylesheets = $page->getStylesheets();
    $navigationStylesheet = $page?->getNavigation()?->getStylesheet();
@endphp

<!doctype html>
<html lang="">
<head>
    <title>{{ $meta->getTitle() }}</title>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @isset($meta)
        <meta name="description" content="{{ $meta->getDescription() }}">
        <meta name="keywords" content="{{ $meta->getKeywords() }}">
        <meta name="author" content="{{ $meta->getAuthor() }}">
    @endisset

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templates.css') }}">

    @isset($navigationStylesheet)
        <link rel="stylesheet" href="{{ asset("css/{$navigationStylesheet}.css") }}">
    @endisset

    @isset($pageStylesheets)
        @foreach($pageStylesheets as $stylesheet)
            <link rel="stylesheet" href="{{ asset("css/{$stylesheet}.css") }}">
        @endforeach
    @endisset
</head>

<body id="{{ $route }}">

<div id="Layout-{{ $layout ?? 'Unknown' }}">
    @yield(LAYOUT)
</div>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>

@isset($scripts)
    @foreach($scripts as $script)
        <script src="{{ $script }}" defer></script>
    @endforeach
@endif

@yield(FOOTER)

</body>
</html>
