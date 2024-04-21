@extends(configDefaultAppScaffold())

@section(LAYOUT)
    @include('fragments.navigation')
    @include('fragments.breadcrumbs')
    @include('fragments.content')
@endsection
