<?php

namespace uzdevid\docman\Output\docx;

use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use uzdevid\docman\Output\Configure;
use uzdevid\docman\Output\Output;
use uzdevid\docman\Save\SaveInterface;

class DocX extends Output {
    /**
     * @var PhpWord
     */
    private PhpWord $phpWord;

    /**
     * @param Configure|array $config
     */
    public function __construct(Configure|array $config = []) {
        $this->phpWord = new PhpWord();

        parent::__construct();
    }

    /**
     * @throws Exception
     */
    public function save(SaveInterface $save): bool {
        $section = $this->phpWord->addSection();

        Html::addHtml($section, $this->content);

        $objWriter = IOFactory::createWriter($this->phpWord);
        $objWriter->save('helloWorld.docx');

        return true;
    }
}