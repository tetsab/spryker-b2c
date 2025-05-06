<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Reader;

use Generated\Shared\Transfer\AntelopeLocationTransfer;

class AntelopeLocationReader
{
    public function findLocationById(int $id): ?AntelopeLocationTransfer
    {
        $transfer = new AntelopeLocationTransfer();
        $transfer->setIdAntelopeLocation($id);
        $transfer->setName('Sample Location #' . $id);

        return $transfer;
    }
}
