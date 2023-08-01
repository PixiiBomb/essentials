@php
    /**
     * @var $data
     */
    if(!isset($data)) { return; }
@endphp

<div class="card">
    <div class="card-header">
        {{ $data->getTitle() }}
    </div>

    <div class="card-body">
        <form action="{{ route($data->getAction()) }}" method="{{ $data->getMethod() }}">

            @csrf

            @yield(INPUT)

            <button class="btn btn-block btn-primary" type="submit">{{ $data->getSubmit() }}</button>

        </form>
    </div>
</div>
