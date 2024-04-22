@php
    /** @var $page  */
    if(!isset($page))
    {
        dd("Unable to display app.blade.php - the Page object is not set. Please refer to documentation for additional information");
    }

    $meta = $page?->getMeta();
    $scripts = $page?->getScripts();
    $pageStylesheets = $page->getStylesheets();
    $navigationStylesheet = $page?->getNavigation()?->getStylesheet();
@endphp

    <!doctype html>
<html lang="">
<head>
    <title>{{ isset($meta) ? $meta->getTitle() : config('app.name') }}</title>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

<body id="{{ $id ?? 'Body-Unknown' }}">

<main id="{{ $layout ?? 'Layout-Unknown' }}">
    @yield(LAYOUT)
</main>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>

@isset($scripts)
    @foreach($scripts as $script)
        <script src="{{ $script }}" defer></script>
    @endforeach
@endif

</body>

<footer>
    @include('includes.footer')
</footer>
</html>
