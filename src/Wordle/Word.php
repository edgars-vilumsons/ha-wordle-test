<?php

namespace Wordle;

use Exception;

use function PHPUnit\Framework\throwException;

final class Word {

    private $letters;

    function __construct(string $letters)
    {
        if (strlen($letters) < 5)
        throw new \Exception('To few letters. Should be 5');
        if (strlen($letters) > 5)
        throw new \Exception('Too many letters. Should be 5');
        if (!\preg_match('/^[a-z]+$/i', $letters))
        throw new \Exception('word contain invalid latters');

        $this->letters = $letters;
    }

    function letters(): array {
        return str_split($this->letters);
    }

    function matchesPositionWith(Word $anotherWord): array {
        $positions = [];
        for ($currentPosition = 0; $currentPosition < count($this->letters()); $currentPosition++) {
            if ($this->letters()[$currentPosition] == $anotherWord->letters()[$currentPosition]) {
                $positions[] = $currentPosition;
            }
        }
        return $positions;
    }

    function matchesIncorrectpositionWith(Word $anotherWord): array {
        $positions = [];
        for ($currentPosition = 0; $currentPosition < count($this->letters()); $currentPosition++) {
            if (in_array($this->letters()[$currentPosition], $anotherWord->letters())) {
                $positions[] = $currentPosition;
            }
        }
        return array_values(array_diff($positions, $this->matchesPositionWith($anotherWord)));
    }
}