@extends(getPrimaryLayout())

@section(LAYOUT)
    <div class="container-fluid">
        <div class="row">
            @yield(NAVIGATION)
            @yield(CONTENT)
        </div>
    </div>
@endsection
