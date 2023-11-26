<?php

namespace uzdevid\docman\Save;

interface SaveInterface {
    /**
     * @param string $content
     *
     * @return bool
     */
    public function save(string $content): bool;
}