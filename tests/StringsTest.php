<?php

namespace PhpUtils;

use PHPUnit\Framework\TestCase;

class StringsTest extends TestCase
{

    /**
     * @dataProvider containsOneOfProvider
     */
    public function testContainsOneOf(string $haystack, array $needle, bool $expected): void
    {
        $contains = Strings::containsOneOf($haystack, $needle);

        self::assertEquals($expected, $contains);
    }

    public function containsOneOfProvider(): array
    {
        return [
          "accepts single value" => ["abcde", ["ab"], true],
          "accepts multiple values" => ["abcde", ["ee", "ab"], true],
        ];
    }

    /**
     * @dataProvider getWordsProvider
     */
    public function testGetWords(string $sentence, int $offset, ?int $count, string $expected): void
    {
        $words = Strings::getWords($sentence, $offset, $count);

        self::assertEquals($expected, $words);
    }

    public function getWordsProvider(): array
    {
        return [
            'get start of the sentence' => ["Mom washed the window.", 0, 2, "Mom washed"],
            'get rest of the sentence' => ["Mom washed the window.", 2, null, "the window."],
        ];
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
