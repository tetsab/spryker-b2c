<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Writer;

use Generated\Shared\Transfer\AntelopeLocationTransfer;

class AntelopeLocationWriter
{
    public function createLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        $antelopeLocationTransfer->setIdAntelopeLocation(rand(1, 1000));

        return $antelopeLocationTransfer;
    }
}
