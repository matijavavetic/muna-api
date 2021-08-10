<?php

namespace src\Business\Mappers\Check\Request;

class CheckRequestMapper
{
    public function __construct(
        private string $value,
        private string $userId
    ) {}

    public function getValue(): string
    {
        return $this->value;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}