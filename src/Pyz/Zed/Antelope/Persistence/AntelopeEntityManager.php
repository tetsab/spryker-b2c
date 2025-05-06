<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocation;

class AntelopeEntityManager implements AntelopeEntityManagerInterface
{
    protected AntelopePersistenceFactory $factory;

    public function __construct(AntelopePersistenceFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param AntelopeTransfer $transfer
     *
     * @return AntelopeTransfer
     */
    public function createAntelope(AntelopeTransfer $transfer): AntelopeTransfer
    {
        $entity = new PyzAntelope();
        $entity->fromArray($transfer->toArray());
        $entity->save();

        return $transfer->fromArray($entity->toArray(), true);
    }

    public function updateAntelope(AntelopeTransfer $transfer): AntelopeTransfer
    {
        $entity = PyzAntelopeQuery::create()->findOneByIdAntelope($transfer->getIdAntelope());

        if ($entity) {
            $entity->fromArray($transfer->toArray());
            $entity->save();
            return $transfer->fromArray($entity->toArray(), true);
        }

        return $transfer;
    }

    public function createAntelopeLocation(AntelopeLocationTransfer $transfer): AntelopeLocationTransfer
    {
        $entity = new PyzAntelopeLocation();
        $entity->fromArray($transfer->toArray());
        $entity->save();

        return $transfer->fromArray($entity->toArray(), true);
    }
}
