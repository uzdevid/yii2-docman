<?php

namespace uzdevid\docman\Output\pdf;

use uzdevid\docman\Output\Configure;
use yii\base\InvalidArgumentException;

/**
 * Class Config
 *
 * @property string $orientation
 * @property string $format
 * @property string $mode
 * @property int $marginTop
 * @property int $marginLeft
 * @property int $marginRight
 * @property int $marginBottom
 * @property int $marginHeader
 * @property int $marginFooter
 */
class Config extends Configure {
    protected array $allowedOrientations = ['P', 'L'];
    protected array $allowedFormats = ['A4', 'A5', 'A6', 'A7', 'A8', 'Letter', 'Legal', 'Executive', 'Folio', 'Tabloid'];

    protected array $allowedModes = ['utf-8', 'utf-16', 'utf-32', 'windows-1252', 'ISO-8859-1', 'ISO-8859-2', 'ISO-8859-15', 'cp866', 'cp1251', 'KOI8-R', 'BIG5', 'GB2312', 'BIG5-HKSCS', 'Shift_JIS', 'EUC-JP', 'MacRoman'];

    private array $defaultParams = [
        'orientation' => 'P',
        'format' => 'A4',
        'mode' => 'utf-8',
        //
        'margin_top' => 8,
        'margin_left' => 8,
        'margin_right' => 8,
    ];

    /**
     * @param array $params
     */
    public function __construct(array $params = []) {
        $params = array_merge($this->defaultParams, $params);
        parent::__construct($params);
    }

    /**
     * @param string $orientation
     *
     * @return $this
     */
    public function setOrientation(string $orientation): static {
        if (!in_array($orientation, $this->allowedOrientations, true)) {
            throw new InvalidArgumentException('Orientation must be P or L');
        }

        return $this->setParam('orientation', $orientation);
    }

    /**
     * @return string
     */
    public function getOrientation(): string {
        return $this->getParam('orientation');
    }

    /**
     * @param string $format
     *
     * @return $this
     */
    public function setFormat(string $format): static {
        if (!in_array($format, $this->allowedFormats, true)) {
            throw new InvalidArgumentException('Format must be A4, A5, A6, A7, A8, Letter, Legal, Executive, Folio, Tabloid');
        }

        return $this->setParam('format', $format);
    }

    /**
     * @return string
     */
    public function getFormat(): string {
        return $this->getParam('format');
    }

    /**
     * @param string $mode
     *
     * @return $this
     */
    public function setMode(string $mode): static {
        if (!in_array($mode, $this->allowedModes, true)) {
            throw new InvalidArgumentException('Mode must be utf-8, utf-16, utf-32, windows-1252, ISO-8859-1, ISO-8859-2, ISO-8859-15, cp866, cp1251, KOI8-R, BIG5, GB2312, BIG5-HKSCS, Shift_JIS, EUC-JP, MacRoman');
        }

        return $this->setParam('mode', $mode);
    }

    /**
     * @return string
     */
    public function getMode(): string {
        return $this->getParam('mode');
    }

    /**
     * @param int $margin
     *
     * @return $this
     */
    public function setMarginTop(int $margin): static {
        return $this->setParam('margin_top', $margin);
    }

    /**
     * @return int
     */
    public function getMarginTop(): int {
        return $this->getParam('margin_top');
    }

    /**
     * @param int $margin
     *
     * @return $this
     */
    public function setMarginLeft(int $margin): static {
        return $this->setParam('margin_left', $margin);
    }

    /**
     * @return int
     */
    public function getMarginLeft(): int {
        return $this->getParam('margin_left');
    }

    /**
     * @param int $margin
     *
     * @return $this
     */
    public function setMarginRight(int $margin): static {
        return $this->setParam('margin_right', $margin);
    }

    /**
     * @return int
     */
    public function getMarginRight(): int {
        return $this->getParam('margin_right');
    }

    /**
     * @param int $margin
     *
     * @return $this
     */
    public function setMarginBottom(int $margin): static {
        return $this->setParam('margin_bottom', $margin);
    }

    /**
     * @return int
     */
    public function getMarginBottom(): int {
        return $this->getParam('margin_bottom');
    }

    /**
     * @param int $margin
     *
     * @return $this
     */
    public function setMarginHeader(int $margin): static {
        return $this->setParam('margin_header', $margin);
    }

    /**
     * @return int
     */
    public function getMarginHeader(): int {
        return $this->getParam('margin_header');
    }

    /**
     * @param int $margin
     *
     * @return $this
     */
    public function setMarginFooter(int $margin): static {
        return $this->setParam('margin_footer', $margin);
    }

    /**
     * @return int
     */
    public function getMarginFooter(): int {
        return $this->getParam('margin_footer');
    }
}