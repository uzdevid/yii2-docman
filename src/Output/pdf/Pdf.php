<?php

namespace uzdevid\docman\Output\pdf;

use Mpdf\Mpdf;
use Mpdf\MpdfException;
use uzdevid\docman\Output\Configure;
use uzdevid\docman\Output\Output;
use uzdevid\docman\Save\SaveInterface;
use Yii;

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
        $this->mpdf = new Mpdf($config->params);

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