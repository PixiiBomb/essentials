@php
    $data = (new PixiiBomb\Essentials\View\Components\Form())
            ->setAction('user.update.profile')
            ->setSubmit('Save');
@endphp

@section(INPUT)

    <div class="form-group" id="{{ concatenateId(INPUT, USERNAME) }}">
        <label for="{{ USERNAME }}">Username</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bd-indigo-100" aria-hidden="true"></i>
            </span>
            <input type="text" class="form-control" placeholder="username"
                   aria-label="{{ USERNAME }}"
                   id="{{ USERNAME }}"
                   name="{{ USERNAME }}"
                   value="{{ old(USERNAME) }}" required>
            @error(USERNAME) {{ $message }} @enderror
        </div>
    </div>

    <div class="form-group" id="{{ concatenateId(INPUT, EMAIL) }}">
        <label for="{{ EMAIL }}">Change Email Address</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-heart"></i>
            </span>
            <input type="email" class="form-control" placeholder="your@email.com"
                   aria-label="Change email address"
                   id="{{ EMAIL }}"
                   name="{{ EMAIL }}"
                   value="{{ old(EMAIL) }}" required>
            @error(EMAIL) {{ $message }} @enderror
        </div>
    </div>

    <label for="{{ PASSWORD }}">Password
        <input type="password" class="form-control" placeholder="password" name="{{ PASSWORD }}" value="{{ old(PASSWORD) }}">
        @error(PASSWORD){{ $message }}@enderror
    </label>

@endsection

<x-dynamic-component :component="FORM" :data="$data"></x-dynamic-component>
