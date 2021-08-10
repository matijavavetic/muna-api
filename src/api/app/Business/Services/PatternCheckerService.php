<?php

namespace src\Business\Services;

use DateTime;
use Illuminate\Support\Facades\Cookie;
use src\Business\Exceptions\NotFoundException;
use src\Business\Factories\Stat\StatResponseMapperFactory;
use src\Business\Helpers\Contracts\PatternCheckerInterface;
use src\Business\Mappers\Check\Request\CheckRequestMapper;
use src\Business\Mappers\Stat\Request\StatRequestMapper;
use src\Business\Mappers\Stat\Response\StatResponseMapper;
use src\Data\Entities\HistoryItem;
use src\Data\Entities\Info;
use src\Data\Repositories\Contracts\CacheInterface;
use src\Data\Repositories\Contracts\RepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class PatternCheckerService
{
    public function __construct(
        private PatternCheckerInterface $patternCheckerInterface,
        private RepositoryInterface $repositoryInterface,
        private CacheInterface $cacheInterface
    ) {}

    public function check(CheckRequestMapper $mapper): bool
    {
        $patternCheckerResult = $this->patternCheckerInterface->check($mapper->getValue());

        $resultToString = $patternCheckerResult ? 'true' : 'false';
        
        $info = $this->repositoryInterface->fetchInfoByUserId($mapper->getUserId());
        
        if (! $info) {            
            $info = new Info();
            $info
                ->setSolved($patternCheckerResult)
                ->setUserId($mapper->getUserId());
        } 
        
        $historyItem = new HistoryItem();
        $historyItem
            ->setTime(new DateTime('now'))
            ->setValue($mapper->getValue())
            ->setInfo($info);
        
        $info
            ->setSolved($patternCheckerResult)
            ->addHistoryItem($historyItem);

        $this->repositoryInterface->save($info);
        $this->repositoryInterface->save($historyItem);

        $this->cacheInterface->updateInfoState(
            $mapper->getUserId(),
            $resultToString
        );
        
        $this->cacheInterface->attachHistoryItemToInfo(
            $mapper->getUserId(), 
            $historyItem
        );

        if ($patternCheckerResult) {
            $this->cacheInterface->deleteInfoByUserId($mapper->getUserId());
            Cookie::forget('user_id');
        }

        return $patternCheckerResult;
    }

    public function stat(StatRequestMapper $mapper): StatResponseMapper
    {
        $info = $this->cacheInterface->findInfoByUserId($mapper->getUserId());

        if (! $info) {
            throw new NotFoundException(
                'No game info related to your id found.',
                Response::HTTP_NOT_FOUND
            );
        }

        $responseMapper = StatResponseMapperFactory::make($info);

        return $responseMapper;
    }
}