<?php

namespace src\Business\Services;

use src\Applications\Enums\StateEnum;
use src\Business\Mappers\Check\Request\CheckRequestMapper;

class GuessingGameService
{
    public function __construct() {}

    public function check(CheckRequestMapper $mapper)
    {
        $value = str_split(strtolower($mapper->getValue()), 1);


       // $lastCharacterIndex = strlen($value) - 1;

        $vowels = [
            'a' => true, 
            'e' => true, 
            'i' => true, 
            'o' => true, 
            'u' => true
        ];

        $currentGameState = StateEnum::UNSOLVED;

            if ($this->checkIfFirstIsNotVowelAndLastIsExclamationMark($value, $vowels)) {
                $currentGameState = StateEnum::SOLVED;
            }

            if ($this->checkIfSecondIsNotAVowel($value, $vowels)) {
                return $currentGameState;
            }

            $sliced = substr($mapper->getValue(), 2, count($value)-1);
            $rest = str_split(substr($mapper->getValue(), 2, count($value)-1));

            $rest = $this->getRestOfUncheckedLetters();

            foreach ($rest as $index => $letter) {
                if ($letter === '#') {
                    $currentGameState = StateEnum::SOLVED;
                    break;
                }

                $this->checkIsItHash();

                if (isset($vowels[$letter])) {
                    if ($index === strlen($sliced) - 1) {
                        $currentGameState = StateEnum::SOLVED;
                    }

                    continue;
                }

                $this->checkIfVowel();
                $this->checkIfTheLastLetterIsAVowel();
                $this->checkIfTheLetterisB();
                $this->checkIfTheRestOfStringEqualsAguette();

                if ($letter = 'b') {
                    $afterLetterB = substr($sliced, $index+1, strlen($sliced)-1);

                    if ($afterLetterB === 'aguette') {
                        $currentGameState = StateEnum::SOLVED;
                        break;
                    }
                }
            }

        dd($currentGameState);
    }

    private function checkIfFirstIsNotVowelAndLastIsExclamationMark(array $value, array $vowels)
    {
        if (
            ! isset($vowels[$value[0]])
            && $value[count($value)-1] === '!'
        ) {
            return true;
        }

        return false;
    }

    private function checkIfSecondIsNotAVowel(array $value, array $vowels)
    {
        if (! isset($vowels[$value[1]])) {
            return true;
        }

        return false;
    }
}