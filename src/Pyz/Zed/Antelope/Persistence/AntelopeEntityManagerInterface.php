<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;

interface AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer;

    public function updateAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer;

    public function createAntelopeLocation(AntelopeLocationTransfer $locationTransfer): AntelopeLocationTransfer;
}
