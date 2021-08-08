<?php

namespace src\Business\Helpers;

interface PatternCheckerInterface
{
    public function check(string $value): bool;
}