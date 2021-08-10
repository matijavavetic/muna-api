<?php

namespace src\Data\Repositories;

use Illuminate\Support\Facades\Redis;
use src\Data\Entities\HistoryItem;
use src\Data\Repositories\Contracts\CacheInterface;

class RedisRepository implements CacheInterface
{
    public function findInfoByUserId(string $userId): array
    {
        return Redis::lrange($userId, 0, -1);
    }

    public function attachHistoryItemToInfo(string $userId, HistoryItem $historyItem): void
    {
        Redis::rpush($userId, json_encode([
            'time' => $historyItem->getTime()->format('Y-m-d H:i:s'),
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