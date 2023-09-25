@php
    /** @var $page */

    use PixiiBomb\Essentials\Entities\Navigation;
    use PixiiBomb\Essentials\Entities\Items\NavigationItem;

    $navigation = $page?->getNavigation();
    if(!isset($navigation)) { return; }

    $items = [
            (new NavigationItem(HOME, HOME)),
            (new NavigationItem(YOUTUBE, YOUTUBE))
                ->setView('navigation.sub-navigation.youtube')
        ];

    $navigation->setItems($items);
@endphp

<x-navbar :details="$page->getNavigation()"></x-navbar>
