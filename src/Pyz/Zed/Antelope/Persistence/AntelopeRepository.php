<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

class AntelopeRepository extends AbstractRepository implements AntelopeRepositoryInterface
{
    public function findAntelopeById(int $id): ?AntelopeTransfer
    {
        $entity = PyzAntelopeQuery::create()
            ->filterByIdAntelope($id)
            ->joinWithPyzAntelopeLocation()
            ->findOne();

        if (!$entity) {
            return null;
        }

        $transfer = new AntelopeTransfer();
        $transfer->fromArray($entity->toArray(), true);

        $locationEntity = $entity->getPyzAntelopeLocation();
        if ($locationEntity) {
            $locationTransfer = new AntelopeLocationTransfer();
            $locationTransfer->fromArray($locationEntity->toArray(), true);
            $transfer->setLocation($locationTransfer);
        }

        return $transfer;
    }

    public function findAntelopeLocationById(int $id): ?AntelopeLocationTransfer
    {
        $entity = PyzAntelopeLocationQuery::create()->findOneByIdLocation($id);

        if (!$entity) {
            return null;
        }

        return (new AntelopeLocationTransfer())->fromArray($entity->toArray(), true);
    }
}
