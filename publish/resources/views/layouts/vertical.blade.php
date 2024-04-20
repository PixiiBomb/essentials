@extends(configDefaultAppScaffold())

@section(LAYOUT)
    @include('fragments.navigation')
    @include('fragments.breadcrumbs')
    @include('fragments.content')

    <footer>
        @include('includes.footer')
    </footer>
@endsection
