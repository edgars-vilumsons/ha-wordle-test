<?php

use PHPUnit\Framework\TestCase;

class ExampleAssertionsTest extends TestCase {

    public function testThatStringMatch() {

    $string1 = 'string';
    $string2 = 'string';

    $this->assertSame($string1, $string2);
    }

}