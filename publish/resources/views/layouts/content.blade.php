@php
    /** * @var $content */
    if(!isset($content)) { return; }
@endphp

@extends('layouts.app')

@section(BREADCRUMBS)
    @if(!is_null($content->getBreadcrumbs()))
        <x-pixii::breadcrumbs :details="$content->getBreadcrumbs()"/>
    @endif
@endsection

@section(LAYOUT)
    @yield(NAVIGATION)
    @yield(BREADCRUMBS)
    @yield(CONTENT)
@endsection
