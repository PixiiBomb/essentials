@isset($request)
    {{ var_dump($request) }}
@endisset

@section(INPUT)

    <div class="form-group mb">
        <div class="input-group">
            <span class="input-group-text" id="{{ concatenateId(INPUT, USERNAME) }}">@</span>
            <input type="text" class="form-control" placeholder="username" aria-label="{{ USERNAME }}"
                   aria-describedby="{{ concatenateId(INPUT, USERNAME) }}" name="{{ USERNAME }}">
            @error(USERNAME) {{ $message }} @enderror
        </div>
    </div>

    <div class="form-group mb">
        <div class="input-group">
            <span class="input-group-text" id="{{ concatenateId(INPUT, PASSWORD) }}">@</span>
            <input type="password" class="form-control" placeholder="password" aria-label="{{ PASSWORD }}"
                   aria-describedby="{{ concatenateId(INPUT, PASSWORD) }}" name="{{ PASSWORD }}">
            @error(PASSWORD) {{ $message }} @enderror
        </div>
    </div>

    <a href="{{ concatenateRoute(USER, LOGIN) }}" title="Login to the website">Login</a>

@endsection

<x-dynamic-component
    :component="getFromPackage(FORM)"
    :data="$container_data">
</x-dynamic-component>


