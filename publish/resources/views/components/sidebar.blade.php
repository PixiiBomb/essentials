@isset($details)
    <nav class="sidebar">
        @if(!empty($details->getItems()))
            <ul>
                @foreach($details->getItems() as $item)
                    <li class="nav-item{{ urlIsActive($item->getRoute()) ? ' active' : '' }}">
                        <a class="nav-link{{ $item->getDisabled() ? ' disabled' : '' }}"
                           aria-current="page"
                           href="{{ $item->getRoute() }}">
                            {{ $item->getLabel() }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </nav>
@else
    <x-debug>
        This component did not receive any details.
    </x-debug>
@endisset
