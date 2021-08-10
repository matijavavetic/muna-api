<?php

namespace src\Data\Storage;

use Doctrine\ORM\EntityManager;

abstract class AbstractRepository
{
    public function __construct(
        protected EntityManager $entityManager
    ) {}
}