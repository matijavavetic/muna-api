<?php

namespace src\Data\Mappers;

use Illuminate\Database\Eloquent\Collection;
use src\Business\Mappers\Stat\HistoryItemMapper;

class HistoryItemMapperCollection extends Collection
{
    public function set(HistoryItemMapper $mapper): void
    {
        $this->add($mapper);
    }
}