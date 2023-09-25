@php
    /** * @var $details */
    if(!isset($details)) { return; }

    use PixiiBomb\Essentials\Http\Controllers\UserController;

    $items = $details?->getItems();
@endphp

<div class="fixed-top app-navigation">

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @isset($items)
                        @foreach($items as $item)
                            @php
                                $id = formatId($item->getLabel());
                                $subnavId = "Subnav-{$id}";
                                $view = $item?->getView()
                            @endphp
                            @empty($item->getItems())
                                <li class="nav-item" id="{{ $id }}"
                                    @isset($view)
                                        data-subnav="{{ $subnavId }}"
                                    @endisset
                                >
                                    <a class="nav-link
                                    {{ urlIsActive($item->getRoute()) ? ' active' : '' }}
                                    {{ $item->getDisabled() ? ' disabled' : '' }}"
                                       aria-current="page"
                                       href="{{ is_null($item->getView()) ? $item->getRoute() : '#' }}">
                                        {{ $item->getLabel() }}
                                    </a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $item->getLabel() }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($item->getItems() as $group)
                                            @if($group->getName())
                                                <li class="nav-group">
                                                    {{ $group->getName() }}
                                                </li>
                                            @endif
                                            @foreach($group->getItems() as $sub)
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="{{ $sub->getRoute() }}">
                                                        {{ titleCase($sub->getLabel()) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                            <li><hr class="dropdown-divider"></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endempty

                        @endforeach
                    @endisset
                </ul>

                <div>
                    {{ UserController::getRoute(LOGIN) }}
                </div>

            </div>
        </div>
    </nav>

    <div id="Sub-Navigation-Views-Container">
        <div class="container" id="Sub-Navigation-Views">
            <div class="row">
                <div class="col">
                    @isset($items)
                        @foreach($items as $item)
                            @php
                                $id = formatId($item->getLabel());
                                $subnavId = "Subnav-{$id}";
                                $view = $item?->getView()
                            @endphp
                            @isset($view)
                                <div class="subnav" id="{{ $subnavId }}">
                                    @include($item->getView())
                                </div>
                            @endisset
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>

</div>

