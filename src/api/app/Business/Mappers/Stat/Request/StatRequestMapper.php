<?php

namespace src\Business\Mappers\Stat\Request;

class StatRequestMapper
{
    public function __construct(
        private string $userId
    ) {}

    public function getUserId(): string
    {
        return $this->userId;
    }
}