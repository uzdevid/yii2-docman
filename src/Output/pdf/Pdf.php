<?php

namespace uzdevid\docman\Output\pdf;

use Mpdf\Mpdf;
use Mpdf\MpdfException;
use uzdevid\docman\Output\Configure;
use uzdevid\docman\Output\Output;
use uzdevid\docman\Save\SaveInterface;
use Yii;

/**
 * Class Pdf
 *
 * @property string $orientation
 * @property string $format
 * @property string $mode
 * @property int $margin_top
 * @property int $margin_left
 * @property int $margin_right
 * @property int $margin_bottom
 * @property int $margin_header
 * @property int $margin_footer
 */
class Pdf extends Output {
    /**
     * @var Mpdf
     */
    private Mpdf $mpdf;

    /**
     * @throws MpdfException
     */
    public function __construct(Configure|array $config = []) {
        $config = $config instanceof Configure ? $config : new Config($config);
        $this->mpdf = new Mpdf($config->getParams());

        parent::__construct();
    }

    /**
     * @param SaveInterface $save
     *
     * @return bool
     */
    public function save(SaveInterface $save): bool {
        try {
            $this->mpdf->WriteHTML($this->content);
            $content = $this->mpdf->Output('', 'S');
        } catch (MpdfException $e) {
            Yii::error($e->getMessage(), 'docman:output:mpdf');
            return false;
        }

        return $save->save($content);
    }
}