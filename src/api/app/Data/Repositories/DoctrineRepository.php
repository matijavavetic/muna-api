<?php

namespace src\Data\Repositories;

use src\Data\Entities\Contracts\EntityInterface;
use src\Data\Entities\Info;
use src\Data\Repositories\Contracts\RepositoryInterface;

class DoctrineRepository extends AbstractRepository implements RepositoryInterface
{
    public function fetchInfoByUserId(string $userId): ?Info
    {
        $info = $this->em
            ->createQueryBuilder()
            ->select('info')
            ->from(Info::class, 'info')
            ->where('info.userId = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getOneOrNullResult();

        return $info;
    }

    public function save(EntityInterface $entity): EntityInterface
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}