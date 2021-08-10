<?php

namespace src\Data\Repositories\Contracts;

use src\Data\Entities\HistoryItem;

interface CacheInterface
{
    public function findInfoByUserId(string $userId): array;
    public function attachHistoryItemToInfo(string $userId, HistoryItem $historyItem): void;
    public function updateInfoState(string $userId, string $state): void;
    public function deleteInfoByUserId(string $userId): void;
}