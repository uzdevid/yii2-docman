<?php

namespace uzdevid\docman\Save;

class ReturnContent implements SaveInterface {
    /**
     * @var string
     */
    public string $content;

    /**
     * @param mixed $content
     */
    public function __construct(string &$content) {
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