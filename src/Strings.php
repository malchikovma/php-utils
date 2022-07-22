<?php

namespace PhpUtils;

class Strings
{

    /**
     * Find out if string contains one of substrings. Case-insensitive, multi-bite.
     * @param string $string
     * @param string[] $needle
     * @param int $offset
     * @return bool
     *
     * @link https://stackoverflow.com/questions/6284553/using-an-array-as-needles-in-strpos
     */
    public static function containsOneOf(string $string, array $needle, int $offset = 0): bool
    {
        foreach($needle as $query) {
            if (mb_stripos($string, $query, $offset) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get `$count` words from sentence.
     * @param $string string Sentence.
     * @param $offset int Get words starting from word number $offset. Starts from zero.
     * @param $count int|null If missed, get to the end.
     * @return string
     */
    public static function getWords(string $string, int $offset, int $count = null): string
    {
        return implode(' ',
            array_slice(
                explode(' ', $string)
                , $offset, $count)
        );
    }

    /**
     * Считает количество слов в строке
     * @param string $string
     * @param string $alphabet Provide additional alphabet for multi-bite strings.
     * @return int
     * @see StringsAlphabetEnum
     */
    public static function countWords(string $string, string $alphabet = ""): int
    {
        return str_word_count($string, 0, $alphabet);
    }

    /**
     * @param int $now
     * @param int $then Unix timestamp in seconds. E.g. using `strtotime()`.
     * @param array $tokens Map of time to strings
     * @return string
     * @url https://stackoverflow.com/questions/2915864/php-how-to-find-the-time-elapsed-since-a-date-time#2916189
     */
    public static function timePassedSince(int $then, int $now, array $tokens): string
    {
        $then = $now - $then; // to get the time since that moment
        $then = max($then, 1);

        foreach ($tokens as $unit => $text) {
            if ($then < $unit) {
                continue;
            }
            $numberOfUnits = floor($then / $unit);
            return $text . ': ' . $numberOfUnits;
        }
        return '';
    }
}
