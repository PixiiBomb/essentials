@php
    /**
     * @var $details
     */
    if(!isset($details)) { return; }
@endphp

<div class="card">
    <div class="card-header">
        {{ $details->getTitle() }}
    </div>

    <div class="card-body">
        <form action="{{ route($details->getAction()) }}" method="{{ $details->getMethod() }}">

            @csrf

            @yield(INPUT)

            <button class="btn btn-block btn-primary" type="submit">{{ $details->getSubmit() }}</button>

        </form>
    </div>
</div>
