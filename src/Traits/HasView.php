<?php

namespace PixiiBomb\Essentials\Traits;

trait HasView
{
    protected ?string $filename = null;
    protected ?string $attemptedFilename = null;

    public function getFilename(): ?string { return $this->filename; }
    public function getAttemptedFilename(): ?string { return $this->attemptedFilename; }

    public function setFilename(?string $filename): self {
        $this->attemptedFilename = $filename;
        $this->filename = validateView($filename);
        return $this;
    }
}
