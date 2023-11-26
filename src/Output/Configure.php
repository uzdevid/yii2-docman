<?php

namespace uzdevid\docman\Output;

use yii\base\BaseObject;

/**
 * Class Configure
 *
 * @package uzdevid\docman\Output
 *
 * @property array|string[] $params
 */
abstract class Configure extends BaseObject {
    /**
     * @var array
     */
    protected array $_params = [];

    /**
     * @param array $params
     */
    public function __construct(array $params = []) {
        $this->setParams($params);
        
        parent::__construct();
    }

    /**
     * @param array $params
     *
     * @return $this
     */
    public function setParams(array $params): static {
        $this->_params = $params;
        return $this;
    }

    /**
     * @return array|string[]
     */
    public function getParams(): array {
        return $this->_params;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return $this
     */
    public function setParam(string $name, mixed $value): static {
        $this->_params[$name] = $value;
        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getParam(string $name): mixed {
        return $this->_params[$name] ?? null;
    }
}