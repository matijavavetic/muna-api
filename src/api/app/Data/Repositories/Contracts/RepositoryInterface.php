<?php

namespace src\Data\Repositories\Contracts;

use src\Data\Entities\Contracts\EntityInterface;
use src\Data\Entities\Info;

interface RepositoryInterface
{
    public function fetchInfoByUserId(string $userId): ?Info;
    public function save(EntityInterface $entity): EntityInterface;
}