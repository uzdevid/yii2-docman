<?php

namespace uzdevid\docman;

use yii\base\View;

abstract class Document {
    /**
     * @var array
     */
    private array $variables = [];

    /**
     * @var View
     */
    private View $renderer;

    /**
     * @var bool
     */
    protected bool $useLayout = true;

    /**
     * @return string
     */
    abstract public function layoutPath(): string;


    /**
     * @return string
     */
    abstract public function templatePath(): string;

    /**
     * @return string
     */
    abstract public function build(): string;

    /**
     * @param View $renderer
     *
     * @return $this
     */
    public function setRenderer(View $renderer): static {
        $this->renderer = $renderer;
        return $this;
    }

    /**
     * @param array $variables
     *
     * @return $this
     */
    public function setVariables(array $variables): static {
        $this->variables = $variables;
        return $this;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return $this
     */
    public function setVariable(string $name, mixed $value): static {
        $this->variables[$name] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function render(): string {
        $content = $this->renderer->render($this->templatePath(), $this->variables);

        if (!$this->useLayout) {
            return $content;
        }

        return $this->renderer->render($this->layoutPath(), array_merge($this->variables, ['content' => $content]));
    }
}