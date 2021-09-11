<?php

namespace src\Business\Mappers\Stat\Response;

use JsonSerializable;
use src\Data\Mappers\HistoryItemMapperCollection;

class StatResponseMapper implements JsonSerializable
{
    public function __construct(
        private string $state,
        private HistoryItemMapperCollection $historyItems
    ) {}

    public function jsonSerialize()
    {
        return $this->historyItems;
    }
}