<?php

namespace PixiiBomb\Essentials\Http\Controllers;

use Illuminate\View\View;
use PixiiBomb\Essentials\Entities\Page;
use PixiiBomb\Essentials\Entities\Meta;
use PixiiBomb\Essentials\Entities\Section;
use PixiiBomb\Essentials\Widgets\Accordion;
use PixiiBomb\Essentials\Widgets\Carousel;
use PixiiBomb\Essentials\Widgets\Items\AccordionItem;
use PixiiBomb\Essentials\Widgets\Items\ImageItem;

class ExampleController extends PageController
{
    public function index(): View
    {
        $meta = (new Meta('Home On The Range'))
                ->setKeywords('bada bing, bada boom');

        $sections = [
            (new Section($this->widgetFunFaqs()))
                ->setAlias('FAQs'),
            (new Section($this->widgetImageCarousel()))
        ];

        $page = (new Page($sections))
            ->setMeta($meta);
            //->setBreadcrumbs(false);

        return parent::page($page);
    }

    public function widgetFunFaqs(): Accordion
    {
        $items = [
            new AccordionItem(
                null,
                'You boil the hell out of it.'
            ),
            'soup',
            new AccordionItem(
                    'What\'s the best thing about Switzerland?',
                    'I don\'t know, but the flag is a big plus'
            ),
            new AccordionItem(
                    'What do you call someone with no body and no nose?',
                    'Nobody knows.'
            ),
            new AccordionItem(
                    'Why do you never see elephants hiding in trees?',
                    'Because they\'re so good at it.'
            ),
            new AccordionItem(
                    'Why can\'t you hear a pterodactyl go to the bathroom?',
                    'Because the pee is silent.'
            ),
            new AccordionItem(
                    'Why did the invisible man turn down the job offer?',
                    'He couldn\'t see himself doing it.'
            )
        ];

        return (new Accordion())
            ->setItems($items)
            ->setActiveIndexes([0]);
    }

    public function widgetImageCarousel(): Carousel
    {
        $items = [
            new ImageItem(
                "images/1.jpg",
                'You boil the hell out of it.'
            ),
            new ImageItem( // @todo substitute this for something else
                "images/2.jpg",
                'You boil the hell out of it.'
            ),
            new ImageItem(
                "images/3.jpg",
                'You boil the hell out of it.'
            ),
        ];

        return (new Carousel())
            ->setItems($items)
            ->setActiveIndex(0);
    }

}
