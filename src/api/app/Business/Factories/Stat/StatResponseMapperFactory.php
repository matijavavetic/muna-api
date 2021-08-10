<?php

namespace src\Business\Factories\Stat;

use src\Business\Mappers\Stat\HistoryItemMapper;
use src\Business\Mappers\Stat\Response\StatResponseMapper;
use src\Data\Mappers\HistoryItemMapperCollection;

class StatResponseMapperFactory
{
    public static function make(array $data): StatResponseMapper
    {
        $historyMapperCollection = new HistoryItemMapperCollection();

        $infoState = $data[0];

        unset($data[0]);

        foreach ($data as $historyItem) {
            $historyItemJsonToArray = json_decode($historyItem, true);

            $historyItemMapper = new HistoryItemMapper(
                $historyItemJsonToArray['time'],
                $historyItemJsonToArray['value']
            );

            $historyMapperCollection->set($historyItemMapper);
        }

        $responseMapper = new StatResponseMapper(
            $infoState,
            $historyMapperCollection
        );

        return $responseMapper;
    }
}