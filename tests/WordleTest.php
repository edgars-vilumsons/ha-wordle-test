<?php

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Wordle\Word;

final class WordleTest extends TestCase {

    public function test00GreenTest() {
        $string1 = 'string';
        $string2 = 'string';

    $this->assertSame($string1, $string2);
    }

    public function test01ValidWordLetterAreValid() {

        $wordleWord = new Word('valid');
        $this->assertEquals(['v','a','l','i','d'], $wordleWord->letters());
    }

    public function test02FewWordlettersShouldRaiseException() {
        $this->expectException(\Exception::class);
        new Word('vali');
    }

    public function test03TooManyWordLettersShouldRaiseException() {
        $this->expectException(\Exception::class);
        new Word('toolong');
    }

    public function test04EmptyLettersShouldRaiseException() {
        $this->expectException(\Exception::class);
        $wordleWord = new Word('');
    }

    public function test05InvalidLettersShouldRaiseException() {
        $this->expectException(\Exception::class);
        $wordleWord = new Word('vali*');
    }

    public function test06PointShouldRaiseException() {
        $this->expectException(\Exception::class);
        $wordleWord = new Word('v.lid');
    }

    public function test07TwoWordsAreNotSame() {
        $firstWord = new Word('valid');
        $secondWord = new Word('super');
        $this->assertNotEquals($firstWord, $secondWord);
    }

    public function test08TwoWordsAreSame() {
        $firstWord = new Word('valid');
        $secondWord = new Word('valid');
        $this->assertEquals($firstWord, $secondWord);
    }

    public function test09LettersForGrassWord() {
        $grassWord = new Word('grass');
        $this->assertEquals(['g','r','a','s','s'], $grassWord->letters());
    }

    public function test10NoMatch() {
        $firstWord = new Word('grass');
        $secondWord = new Word('valid');
        $this->assertEquals([],$firstWord->matchesPositionWith($secondWord));
    }

    public function test11MatchesFirstLetter() {
        $firstWord = new Word('trees');
        $secondWord = new Word('table');
        $this->assertEquals([0],$firstWord->matchesPositionWith($secondWord));
    }

    public function test12MatchesFirstLetter() {
        $firstWord = new Word('trees');
        $secondWord = new Word('trees');
        $this->assertEquals([0,1,2,3,4],$firstWord->matchesPositionWith($secondWord));
    }

    public function test13MatchesIncorrectPositions() {
        $firstWord = new Word('trees');
        $secondWord = new Word('drama');
        $this->assertEquals([1],$firstWord->matchesPositionWith($secondWord));
        $this->assertEquals([], $firstWord->matchesIncorrectPositionWith($secondWord));
    }

    public function test14MatchesIncorrectPositionsWithMatch() {
        $firstWord = new Word('alarm');
        $secondWord = new Word('drama');
        $this->assertEquals([2],$firstWord->matchesPositionWith($secondWord));
        $this->assertEquals([0,3,4], $firstWord->matchesIncorrectPositionWith($secondWord));
        $this->assertEquals([2], $secondWord->matchesPositionWith($firstWord));
        $this->assertEquals([1,3,4], $secondWord->matchesIncorrectPositionWith($firstWord));
    }

}