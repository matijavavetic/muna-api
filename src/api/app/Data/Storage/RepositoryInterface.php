<?php

namespace src\Data\Storage;

use src\Data\Entities\EntityInterface;
use src\Data\Entities\Info;

interface RepositoryInterface
{
    public function fetchInfoByUserId(string $userId): ?Info;
    public function save(EntityInterface $entity): ?EntityInterface;
}