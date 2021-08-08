<?php

namespace src\Business\Helpers;

use src\Applications\Enums\StateEnum;

class MunaPatternChecker implements PatternCheckerInterface
{
    private array $vowels;

    public function __construct()
    {
        $this->vowels = [
            'a' => true, 
            'e' => true, 
            'i' => true, 
            'o' => true, 
            'u' => true
        ];
    }

    public function check(string $value): bool
    {
        $valueToLowercase = strtolower($value);
        $valueStringToArray = str_split($valueToLowercase, 1);

        $gameState = StateEnum::UNSOLVED;

        if ($this->checkIfFirstIsNotVowelAndLastIsExclamationMark($valueStringToArray)) {
            return StateEnum::SOLVED;
        }

        if ($this->checkIfOneOfFirstTwoIsNotVowel($valueStringToArray)) {
            return StateEnum::UNSOLVED;
        }

        $remainingCharactersArray = $this->getRemainingCharactersArray($valueToLowercase);
        $remainingCharactersString = $this->getRemainingCharactersString($valueToLowercase);

        foreach ($remainingCharactersArray as $index => $character) {
            if ($this->checkIfHash($character)) {
                $gameState = StateEnum::SOLVED;
                break;
            }

            if ($this->checkIfVowel($character, $index, count($remainingCharactersArray))) {
                $gameState = StateEnum::SOLVED;
                break;
            } else {
                continue;
            }

            if ($this->checkIfCharacterIsB($remainingCharactersString, $character, $index)) {
                $gameState = StateEnum::SOLVED;
                break;      
            }
        }

        return $gameState;
    }

    private function checkIfFirstIsNotVowelAndLastIsExclamationMark(array $value): bool
    {
        if (
            ! isset($this->vowels[$value[0]])
            && $value[count($value) - 1] === '!'
        ) {
            return true;
        }

        return false;
    }

    private function checkIfOneOfFirstTwoIsNotVowel(array $value): bool
    {
        if (
            ! isset($this->vowels[$value[0]])
            || ! isset($this->vowels[$value[1]])) {
            return true;
        }

        return false;
    }

    private function checkIfHash(string $character): bool
    {
        if ($character === '#') {
            return true;
        }

        return false;
    }

    private function checkIfVowel(string $character, int $index, int $remainingCharacterCount): bool
    {
        if (isset($this->vowels[$character])) {
            if ($this->checkIfCurrentVowelIsLastCharacter($index, $remainingCharacterCount - 1)) {
                return true;
            }

            return false;
        }

        return false;
    }

    private function checkIfCurrentVowelIsLastCharacter(int $index, int $remainingCharacterCount): bool
    {
        if ($index === $remainingCharacterCount) {
            return true;
        }

        return false;
    }

    private function checkIfCharacterIsB(string $remainingCharactersString, string $character, int $index): bool
    {
        if ($character === 'b') {
            $remainingCharactersAfterB = substr(
                $remainingCharactersString, 
                $index+1, 
                strlen($remainingCharactersString) - 1
            );

            $this->checkIfRemainingEqualsToAguette($remainingCharactersAfterB);
        }

        return false;
    }

    private function checkIfRemainingEqualsToAguette(string $remainingCharacters): bool
    {
        if ($remainingCharacters === 'aguette') {
            return true;
        }

        return false;
    }

    private function getRemainingCharactersArray(string $value): array
    {
        return str_split(substr($value, 2, strlen($value) - 1));
    }

    private function getRemainingCharactersString(string $value): string
    {
        return substr($value, 2, strlen($value) - 1);
    }
}