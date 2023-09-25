@extends(getPrimaryLayout())

@section(LAYOUT)
    @include(getFragment(NAVIGATION))
    @include(getFragment(BREADCRUMBS))
    @include(getFragment(PAGE))
@endsection

@section(FOOTER)
    <footer>
        @include('includes.footer')
    </footer>
@endsection
