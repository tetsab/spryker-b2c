<?php

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeLocationTransfer;

interface AntelopeFacadeInterface
{
    public function createLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer;

    public function findLocationById(int $id): ?AntelopeLocationTransfer;
}
