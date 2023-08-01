<?php

class Navigation
{
    protected array $items = [];

    public function __construct(protected ?string $view)
    {
        $this->setView($view);
    }

    public function getView(): ?string { return $this->view; }
    public function getItems(): array { return $this->items; }

    public function setView(string $view): void
    {
        $folder = NAVIGATION;
        $filename = "$folder.$view";
        $this->view = viewExists($filename);
        $this->setItems($view);
    }

    public function setItems(string $view): void
    {
        //$youtube = new Youtube();

        $this->items = match($view)
        {
            CONTENT => [
          //      YOUTUBE => Playlist::navigation()
            ]
        };
    }
}
