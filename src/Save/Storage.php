<?php

namespace uzdevid\docman\Save;

class Storage implements SaveInterface {
    /**
     * @param string $path
     * @param string $filename
     */
    public function __construct(
        private string $path,
        private string $filename
    ) {
    }

    /**
     * @inheritDoc
     */
    public function save(string $content): bool {
        return file_put_contents($this->path . DIRECTORY_SEPARATOR . $this->filename, $content) !== false;
    }
}