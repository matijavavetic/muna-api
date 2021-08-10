<?php

namespace src\Data\Storage;

use Illuminate\Support\Facades\Redis;
use src\Data\Entities\HistoryItem;

class RedisStorage implements CacheInterface
{
    public function attachHistoryItemToInfo(string $userId, HistoryItem $historyItem): void
    {
        Redis::rpush($userId, json_encode([
            'time' => $historyItem->getTime(),
            'value' => $historyItem->getValue()
        ]));
    }

    public function updateInfoState(string $userId, string $state): void
    {
        $cacheInfo = Redis::lrange($userId, 0, -1);

        if (empty($cacheInfo)) {
            Redis::rpush($userId, $state);
        } else {
            Redis::lset($userId, 0, $state);
        }
    }

    public function deleteInfoByUserId(string $userId): void
    {
        Redis::del($userId);
    }
}