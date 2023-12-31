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
 * @property View|null|string|array $renderer
 * @property-write array $variables
 * @property Output|null $output
 */
class Docman extends Component {
    /**
     * @var View
     */
    private View $_renderer;

    /**
     * @var Document
     */
    private Document $_document;

    /**
     * @var Output|null
     */
    private Output|null $output = null;

    /**
     * @throws InvalidConfigException
     */
    public function init(): void {
        parent::init();

        if (!isset($this->_renderer)) {
            $this->setRenderer();
        }
    }

    /**
     * @throws InvalidConfigException
     */
    public function setRenderer(View|array|string|null $renderer = null): static {
        if ($renderer instanceof View) {
            $this->_renderer = $renderer;
            return $this;
        }

        if (is_null($renderer)) {
            $this->_renderer = Yii::$app->view;
            return $this;
        }

        if (is_array($renderer)) {
            $rendererObject = Yii::createObject($renderer);
        } else {
            $rendererObject = class_exists($renderer) ? Yii::createObject(['class' => $renderer]) : Yii::$app->get($renderer);
        }

        if (!is_subclass_of($rendererObject, View::class)) {
            throw new InvalidConfigException('Renderer must be instance of ' . View::class);
        }

        $this->_renderer = $rendererObject;
        return $this;
    }

    /**
     * @param Output|array|string $output
     *
     * @return $this
     * @throws InvalidConfigException
     */
    public function setOutput(Output|array|string $output): static {
        if ($output instanceof Output) {
            $this->output = $output;
            return $this;
        }

        if (is_array($output)) {
            $outputObject = Yii::createObject($output);
        } else {
            $outputObject = class_exists($output) ? Yii::createObject(['class' => $output]) : Yii::$app->get($output);
        }

        if (!is_subclass_of($outputObject, Output::class)) {
            throw new InvalidConfigException('Output must be instance of ' . Output::class);
        }

        $this->output = $outputObject;
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
     * @param Output|null $output
     *
     * @return Output
     * @throws InvalidConfigException
     */
    public function render(Output|null $output = null): Output {
        if (!is_null($output)) {
            $this->setOutput($output);
        }

        $content = $this->_document->setRenderer($this->_renderer)->build();
        return $this->output->content($content);
    }
}