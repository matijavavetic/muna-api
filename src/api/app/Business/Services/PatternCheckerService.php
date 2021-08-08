<?php

namespace src\Business\Services;

use src\Business\Helpers\PatternCheckerInterface;
use src\Business\Mappers\Check\Request\CheckRequestMapper;

class PatternCheckerService
{
    private PatternCheckerInterface $patternCheckerInterface;

    public function __construct(PatternCheckerInterface $patternCheckerInterface) 
    {
        $this->patternCheckerInterface = $patternCheckerInterface;
    }

    public function check(CheckRequestMapper $mapper): bool
    {
        return $this->patternCheckerInterface->check($mapper->getValue());
    }
}