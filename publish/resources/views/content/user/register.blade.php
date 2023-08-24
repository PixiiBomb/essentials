@php
    $password2 = formatConfirmationInput(PASSWORD);
@endphp

@section(INPUT)


    <div class="form-group">
        <label for="{{ USERNAME }}">Username
            <input type="text"
                   class="form-control" placeholder="Username" name="{{ USERNAME }}"
                   value="{{ old(USERNAME) }}">
            @error(USERNAME){{ $message }}@enderror
        </label>
    </div>

        <label for="{{ EMAIL }}">E-Mail
            <input type="email" class="form-control" placeholder="you@email.com" name={{ EMAIL }}
            value="{{ old(EMAIL) }}">
            @error(EMAIL){{ $message }}@enderror
        </label>

        <label for="{{ PASSWORD }}">Password
            <input type="password" class="form-control" placeholder="password" name="{{ PASSWORD }}" value="{{ old(PASSWORD) }}">
            @error(PASSWORD){{ $message }}@enderror
        </label>

        <label for="{{ $password2 }}">Confirm Password
            <input type="password" class="form-control" placeholder="password" name="{{ $password2 }}" value="{{ old($password2) }}">
            @error(PASSWORD){{ $message }}@enderror
        </label>

    </div>

    <a href="{{ concatenateRoute(USER, LOGIN) }}" title="Login to the website">Login</a>

@endsection

<x-dynamic-component :component="FORM" :data="$container_data"></x-dynamic-component>
