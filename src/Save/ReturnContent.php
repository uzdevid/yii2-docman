<?php

namespace uzdevid\docman\Save;

class ReturnContent implements SaveInterface {
    /**
     * @var string|null
     */
    public string|null $content;

    /**
     * @param mixed $content
     */
    public function __construct(string|null &$content) {
        $this->content = &$content;
    }

    /**
     * @inheritDoc
     */
    public function save(string $content): bool {
        $this->content = $content;
        return true;
    }
}