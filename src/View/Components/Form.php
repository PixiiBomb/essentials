<?php

namespace PixiiBomb\Essentials\Widgets;

use Illuminate\Support\Str;

class Form extends Widget
{
    protected string $action = HASH;
    protected string $method = POST;
    protected ?string $title = null;
    protected string $submit = SUBMIT;

    public function getAction(): string { return $this->action; }
    public function getMethod(): string { return $this->method; }
    public function getTitle(): ?string { return $this->title; }
    public function getSubmit(): string { return $this->submit; }

    public function setAction(string $action = HASH): Form
    {
        $this->action = $action;
        return $this;
    }

    public function setMethod(string $method = POST): Form
    {
        $this->method = $method;
        return $this;
    }

    public function setTitle(?string $title = null): Form
    {
        $this->title = Str::title($title);
        return $this;
    }

    public function setSubmit(string $submit = SUBMIT): Form
    {
        $this->submit = Str::title($submit);
        return $this;
    }

    public function isInvalid(): bool
    {
        return false;
    }

}
