<?php

namespace PixiiBomb\Essentials\Http\Controllers;

use Illuminate\View\View;
use PixiiBomb\Essentials\Models\Content;
use PixiiBomb\Essentials\Models\Meta;
use PixiiBomb\Essentials\View\Components\Accordion;
use PixiiBomb\Essentials\View\Items\AccordionItem;
use PixiiBomb\Essentials\View\Components\Container;

class HomeController extends ContentController
{
    public function index(): View
    {
        $jumbotron = 'jumbotron';

        $meta = new Meta('Home Page');

        $containers = [
            (new Container())
                ->setAlias($jumbotron)
                ->setView($this->localContent($jumbotron))
                ->setIsFluid(true),
            (new Container())
                ->setAlias('FAQs')
                ->setComponent($this->componentFunFaqs())
        ];

        $content = new Content($meta, $containers);

        return parent::view($content);
    }

    public function componentFunFaqs(): Accordion
    {
        $items = [
            new AccordionItem(
                null,
                'You boil the hell out of it.'
            ),
            'soup',
            new AccordionItem(
                    'What\'s the best thing about Switzerland?',
                    'Your Mom' //view('content.home.jumbotron')->with(['data' => 'what up'])
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
            ->setShowIndexes([0]);
    }

}
