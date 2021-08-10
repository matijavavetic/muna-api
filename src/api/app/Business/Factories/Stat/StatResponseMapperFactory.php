<?php

namespace src\Business\Factories\Stat;

use src\Business\Mappers\Stat\HistoryItemMapper;
use src\Business\Mappers\Stat\Response\StatResponseMapper;
use src\Data\Entities\Info;
use src\Data\Mappers\HistoryItemMapperCollection;

class StatResponseMapperFactory
{
    public static function make(Info $info): StatResponseMapper
    {
        $historyMapperCollection = new HistoryItemMapperCollection();

        foreach ($info->getHistoryItems() as $historyItem) {
            $historyItemMapper = new HistoryItemMapper(
                $historyItem->getTime()->format('Y-m-d H:i:s'),
                $historyItem->getValue()
            );

            $historyMapperCollection->set($historyItemMapper);
        }

        $responseMapper = new StatResponseMapper(
            $info->getSolved() ? 'true' : 'false',
            $historyMapperCollection
        );

        return $responseMapper;
    }
}