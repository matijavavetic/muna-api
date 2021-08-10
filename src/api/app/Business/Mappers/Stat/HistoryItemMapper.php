<?php

namespace src\Business\Mappers\Stat;

use JsonSerializable;

class HistoryItemMapper implements JsonSerializable
{
    public function __construct(
        private string $time,
        private string $value
    ) {}

    public function getTime(): string
    {
        return $this->time;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return [
            'time' => $this->time,
            'value' => $this->value,
        ];
    }
}