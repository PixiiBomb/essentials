<?php

namespace PixiiBomb\Essentials\View\Components;

class Debug extends Widget
{
    protected ?string $filename;
    protected ?string $message;
    protected ?string $output;

    public function getFilename(): ?string { return $this->filename; }
    public function getMessage(): ?string { return $this->message; }
    public function getOutput(): ?string { return $this->output; }

    protected function setFilename(?string $filename): Debug
    {
        $this->filename = $filename;
        return $this;
    }

    protected function setMessage(?string $message): Debug
    {
        $this->message = $message;
        return $this;
    }

    protected function setOutput(?string $output): Debug
    {
        $this->output = $output;
        return $this;
    }
}
