<?php

namespace src\Data\Helpers;

use DateTime;
use src\Data\Entities\HistoryItem;
use src\Data\Entities\Info;

class DataConverter
{
    public static function cacheInfoToInfoEntity(array $data): Info
    {
        $info = new Info();

        $info->setSolved($data[0]);

        unset($data[0]);

        foreach ($data as $historyItem) {
            $historyItemJsonToArray = json_decode($historyItem, true);

            $historyItem = new HistoryItem();

            $historyItem
                ->setTime(DateTime::createFromFormat('Y-m-d H:i:s', $historyItemJsonToArray['time']))
                ->setValue($historyItemJsonToArray['value']);

            $info->addHistoryItem($historyItem);
        }

        return $info;
    }
}