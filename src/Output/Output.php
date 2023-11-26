<?php

namespace uzdevid\docman\Output;

use uzdevid\docman\Save\SaveInterface;
use yii\base\Component;

abstract class Output extends Component {
    /**
     * @var string
     */
    protected string $extension;
    
    /**
     * @var string
     */
    protected string $content;

    /**
     * @param string $content
     *
     * @return $this
     */
    public function content(string $content): static {
        $this->content = $content;
        return $this;
    }

    /**
     * @param SaveInterface $save
     *
     * @return bool
     */
    abstract public function save(SaveInterface $save): bool;
}