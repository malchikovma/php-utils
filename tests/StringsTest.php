<?php


use PhpUtils\Strings;
use PHPUnit\Framework\TestCase;
use PhpUtils\StringsAlphabetEnum;
use PhpUtils\StringsTimeTokens;

class StringsTest extends TestCase
{

    public function testContainsFindsSubstring(): void
    {
        $haystack = "abcde";
        $needle = "ab";

        self::assertTrue(Strings::contains($haystack, $needle));
    }

    public function testContainsAcceptArrayOfNeedles(): void
    {
        $haystack = "abcde";
        $needles = ["ee", "de"];

        self::assertTrue(Strings::contains($haystack, $needles));
    }

    public function testGetWords(): void
    {
        $sentence = "Mom washed the window.";

        self::assertEquals("the window.", Strings::getWords($sentence, 2));
        self::assertEquals("Mom washed", Strings::getWords($sentence, 0, 2));
    }

    public function testCountWordsEN(): void
    {
        $sentence = "Mom washed the window.";
        $number = Strings::countWords($sentence);
        self::assertEquals(4, $number);
    }

    public function testCountWordsRU(): void
    {
        $sentence = "Мама мыла раму.";
        $number = Strings::countWords($sentence, StringsAlphabetEnum::RU);
        self::assertEquals(3, $number);
    }

    public function testTimePassedSince(): void
    {
        $now = time();
        $hourAgo = strtotime('-1 hour');
        $timePassed = Strings::timePassedSince($hourAgo, $now, StringsTimeTokens::EN);
        self::assertEquals("Hours ago: 1", $timePassed);
    }

}
