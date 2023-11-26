<?php

namespace uzdevid\docman;

use uzdevid\docman\Output\Output;
use Yii;
use yii\base\Component;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\base\View;

/**
 *
 * @property-write array $variables
 * @property View|null|string|array $renderer
 */
class Docman extends Component {
    /**
     * @var Output|null
     */
    public Output|null $output = null;
    
    /**
     * @var View
     */
    private View $_renderer;

    /**
     * @var Document
     */
    private Document $_document;

    /**
     * @throws InvalidConfigException
     */
    public function setRenderer(View|array|string|null $renderer): static {
        $this->_renderer = match (true) {
            is_array($renderer) => Yii::createObject($renderer),
            is_string($renderer) => class_exists($renderer) ? Yii::createObject(['class' => $renderer]) : Yii::$app->get($renderer),
            is_null($renderer) => Yii::$app->view,
            default => throw new InvalidConfigException('Renderer must be array, string or null')
        };

        if (!is_subclass_of($this->_renderer, View::class)) {
            throw new InvalidConfigException('Renderer must be instance of ' . View::class);
        }

        return $this;
    }

    /**
     * @param Document|string $document
     *
     * @return Docman
     * @throws InvalidArgumentException
     */
    public function document(Document|string $document): static {
        if (is_string($document)) {
            if (!is_subclass_of($document, Document::class)) {
                throw new InvalidArgumentException('Document must be instance of ' . Document::class);
            }

            $document = new $document();
        }

        $this->_document = $document;

        return $this;
    }

    /**
     * @param array $variables
     *
     * @return $this
     */
    public function setVariables(array $variables): static {
        $this->_document->setVariables($variables);
        return $this;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return $this
     */
    public function setVariable(string $name, mixed $value): static {
        $this->_document->setVariable($name, $value);
        return $this;
    }

    /**
     * @return Output
     */
    public function render(): Output {
        $content = $this->_document->setRenderer($this->_renderer)->build();
        return $this->output->content($content);
    }
}