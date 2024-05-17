<?php

namespace PixiiBomb\Essentials\Widgets\Items;

use Illuminate\View\View;

class AccordionItem extends CollectionItem
{
    public function __construct(protected $header, protected string|View $body)
    {
        $this->type = ACCORDION;
    }

    public function getHeader() { return $this->header; }
    public function getBody(): string|View { return $this->body; }

    public function setHeader($header): AccordionItem
    {
        $this->header = $header;
        return $this;
    }

    public function setBody(string|View $body): AccordionItem
    {
        $this->body = $body;
        return $this;
    }
}
