<?php

namespace src\Business\Mappers\Check\Request;

class CheckRequestMapper
{
    private string $value;
    private string $userId;

    public function __construct(
        string $value,
        string $userId
    ) {
        $this->value = $value;
        $this->userId = $userId;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}