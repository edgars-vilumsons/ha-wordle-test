<?php

namespace Wordle;
use Wordle\Word;

use PHPUnit\Framework\TestCase;

    final class DictionaryTest extends TestCase {

        public function test01EmptyDictionary() {
            $dictionary = new Dictionary([]);
            $this->assertEquals(0, $dictionary->wordsCount());
        }

        public function test02SingleDictionaryReturns1AsCount() {
            $words = [new Word('happy')];
            $dictionary = new Dictionary($words);
            $this->assertEquals(1, $dictionary->wordsCount());
        }

        public function test03DictionaryDoesNotIncludeWord() {
            $words = [new Word('boobs')];
            $dictionary = new Dictionary($words);
            $this->assertFalse($dictionary->includesWord(new Word('happy')));
        }

        public function test04DictionaryIncludesWord() {
            $words = [new Word('happy')];
            $dictionary = new Dictionary($words);
            $this->assertTrue($dictionary->includesWord(new Word('happy')));
        }

    }
