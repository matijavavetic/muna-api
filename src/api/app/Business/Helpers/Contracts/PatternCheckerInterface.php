<?php

namespace src\Business\Helpers\Contracts;

interface PatternCheckerInterface
{
    public function check(string $value): bool;
}