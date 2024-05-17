@extends(config(DEFAULT_APP_SCAFFOLD))

@section(LAYOUT)
    @include('fragments.navigation')
    @include('fragments.breadcrumbs')
    @include('fragments.content')
@endsection
