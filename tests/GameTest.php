<?php

use PHPUnit\Framework\TestCase;
use Wordle\Dictionary;
use Wordle\Game;
use Wordle\Word;

final class GameTest extends TestCase {

    private $commonDictionary;
    private $commonWinnerWord;

    protected function setUp(): void {
        $words = [
            new Word('noobs'), 
            new Word('boobs'),
            new Word('loser'),
            new Word('happy')];
        $winnerWord = new Word('happy');
        $this->commonDictionary = new Dictionary($words);
        $this->commonWinnerWord = new Word('happy');
    }


    public function test01EmptyGameHasNoWinner() {
        $game = new Game($this->commonDictionary,$this->commonWinnerWord);
        $this->assertFalse($game->hasWon());
    }

    public function test02EmptyGameHasNoWinner() {
        $game = new Game($this->commonDictionary, $this->commonWinnerWord);
        $this->assertEquals([], $game->wordsTried());
    }

    public function test03TryOneWordAndRecordIt() {
        $game = new Game($this->commonDictionary, $this->commonWinnerWord);
        $game->addTry(new Word('boobs'));
        $this->assertEquals([new Word('boobs')], $game->wordsTried());
    }

    public function test04TryOneWordAndDontlooseYet() {
        $game = new Game($this->commonDictionary, $this->commonWinnerWord);
        $game->addTry(new Word('loser'));
    
        $this->assertFalse($game->hasLost());
    }

    public function test05TryFiveWordsLoses() {
        $game = new Game($this->commonDictionary, $this->commonWinnerWord);
        $game->addTry(new Word('loser'));
        $game->addTry(new Word('loser'));
        $game->addTry(new Word('loser'));
        $game->addTry(new Word('loser'));
        $game->addTry(new Word('loser'));
    
        $this->assertFalse($game->hasLost());
    }

    public function test06GuessesWord() {
        $words = [new Word('happy')];
        $dictionary = new Dictionary($words);
        $winnerWord = new Word('happy');
        $game = new Game($dictionary, $winnerWord);
        $this->assertFalse($game->hasWon());
        $game->addTry(new Word('happy'));
        $this->assertTrue($game->hasWon());

    }

    public function test07WinnerWordNotInDictionary() {
        $winnerWord = new Word('label');
        $this->expectException(\Exception::class);
        $game = new Game($this->commonDictionary, $winnerWord);
        
    }
}