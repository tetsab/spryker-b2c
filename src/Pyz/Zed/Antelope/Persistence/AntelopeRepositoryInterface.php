<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;

interface AntelopeRepositoryInterface
{
    public function findAntelopeById(int $id): ?AntelopeTransfer;

    public function findAntelopeLocationById(int $id): ?AntelopeLocationTransfer;
}
