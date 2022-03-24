<?php

namespace Wordle;

final class Game {

    private $wordsTried;
    private $dictionary;
    private $winnerWord;

    function __construct(Dictionary $validWords, Word $winnerWord)
    {
        if (!$validWords->includesWord($winnerWord)){
            throw new \Exception('Winner word must be in dictionary');
        }

        $this->dictionary = $validWords;
        $this->wordsTried = [];
        $this->winnerWord = $winnerWord;
    }

    function hasWon(): bool {
        return in_array($this->winnerWord, $this->wordsTried);
    }

    function wordsTried(): array {
        return $this->wordsTried;
    }

    function addTry(Word $trial) {
        if (!$this->dictionary->includesWord($trial)) {
            throw new \Exception('Word is not included' . $trial);
        }
        return $this->wordsTried[] = $trial;
    }

    function hasLost(): bool {
        return count($this->wordsTried) > 5;
    }

}