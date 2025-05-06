<?php

namespace Pyz\Zed\Antelope\Business;

use Pyz\Zed\Antelope\Business\AntelopeLocation\Reader\AntelopeLocationReader;
use Pyz\Zed\Antelope\Business\AntelopeLocation\Writer\AntelopeLocationWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class AntelopeBusinessFactory extends AbstractBusinessFactory
{
    public function createAntelopeLocationWriter(): AntelopeLocationWriter
    {
        return new AntelopeLocationWriter();
    }

    public function createAntelopeLocationReader(): AntelopeLocationReader
    {
        return new AntelopeLocationReader();
    }
}
