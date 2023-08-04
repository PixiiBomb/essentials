@php
    /** @var $content  */
    if(!isset($content)) { return; }
    $meta = $content->getMeta();
    $scripts = $content->getScripts();
@endphp

    <!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $meta->getDescription() }}">
    <meta name="keywords" content="{{ $meta->getKeywords() }}">
    <meta name="author" content="{{ $meta->getAuthor() }}">

    <title>{{ $meta->getTitle() }}</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>

@yield(LAYOUT)

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>

@isset($scripts)
    @foreach($scripts as $script)
        <script src="{{ $script }}" defer></script>
    @endforeach
@endif

</body>

<footer></footer>

</html>
