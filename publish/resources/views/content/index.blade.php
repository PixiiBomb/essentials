@php
    /** * @var $content */
    if(!isset($content)) { return; }
@endphp

@extends('layouts.content')

@section(BREADCRUMBS)
    @if(!is_null($content->getBreadcrumbs()))
        <x-dynamic-component
            :component="{{BREADCRUMBS}}"
            :data="$content->getBreadcrumbs()">
        </x-dynamic-component>
    @endif
@endsection

@section(NAVIGATION)
    @if(!is_null($content->getNavigation()))
        @include($content->getNavigation())
    @endif
@endsection

@section(CONTENT)
    @if(!is_null($content->getContainers()))
        @foreach($content->getContainers() as $container)
            <x-dynamic-component
                :component="{{CONTAINER}}"
                :data="$container"
                :errors="$errors">
            </x-dynamic-component>
        @endforeach
    @endif
@endsection
