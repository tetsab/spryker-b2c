<?php

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 */
class AntelopeFacade extends AbstractFacade implements AntelopeFacadeInterface
{
    public function createLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        return $this->getFactory()
            ->createAntelopeLocationWriter()
            ->createLocation($antelopeLocationTransfer);
    }

    public function findLocationById(int $id): ?AntelopeLocationTransfer
    {
        return $this->getFactory()
            ->createAntelopeLocationReader()
            ->findLocationById($id);
    }
}
