<?php

namespace src\Data\Repositories\Contracts;

use src\Data\Entities\HistoryItem;
use src\Data\Entities\Info;

interface CacheInterface
{
    public function findInfoByUserId(string $userId): ?Info;
    public function attachHistoryItemToInfo(string $userId, HistoryItem $historyItem): void;
    public function updateInfoState(string $userId, string $state): void;
    public function deleteInfoByUserId(string $userId): void;
}