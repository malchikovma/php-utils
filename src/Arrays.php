<?php

namespace PhpUtils;

class Arrays
{

    /**
     * Manual sort first values of the 2D array.
     *
     * Example:
     * $rows = [
     *  ['id' => 1],
     *  ['id' => 2],
     *  ['id' => 3],
     * ]
     *
     * $prioritizedArray = prioritizeRowsByColumn($rows, 'id', [2, 3]);
     *
     * $prioritizedArray = [
     *  ['id' => 2],
     *  ['id' => 3],
     *  ['id' => 1],
     * ]
     *
     * @param array $rows
     * @param string $column
     * @param array $prioritizedValues
     * @return array
     */
    public static function prioritizeRowsByColumn(array $rows, string $column, array $prioritizedValues): array
    {
        $prioritizedRows = self::extractPrioritized($rows, $column, $prioritizedValues);
        return self::prependByPriority($prioritizedValues, $prioritizedRows, $rows);
    }

    /**
     * @param array $rows
     * @param string $column
     * @param array $priorityIds
     * @return array
     */
    private static function extractPrioritized(array &$rows, string $column, array $priorityIds): array
    {
        $prioritizedRows = [];
        foreach ($rows as $index => $row) {
            if (in_array($row[$column], $priorityIds)) {
                $prioritizedRows[] = $row;
                unset($rows[$index]);
            }
        }
        return $prioritizedRows;
    }

    /**
     * @param array $prioritizedValues
     * @param array $prioritizedRows
     * @param array $rows
     * @return array
     */
    private static function prependByPriority(array $prioritizedValues, array $prioritizedRows, array $rows): array
    {
        foreach (array_reverse($prioritizedValues) as $id) {
            $row = self::findRow($prioritizedRows, 'id', $id);
            if (empty($row)) {
                continue;
            }
            array_unshift($rows, $row);
        }
        return $rows;
    }

    /**
     * Find row in 2D array by column value.
     * @param array $rows
     * @param string $column
     * @param $value
     * @return array|null
     */
    public static function findRow(array $rows, string $column, $value): ?array
    {
        $rowIndex = array_search($value, array_column($rows, $column));
        if ($rowIndex !== false) {
            return $rows[$rowIndex];
        }
        return null;
    }

    /**
     * @param callable $callable
     * @param array $array
     * @return Mixed|null
     */
    public static function find(callable $callable, array $array)
    {
        foreach ($array as $item) {
            if ($callable($item)) {
                return $item;
            }
        }
        return null;
    }

    /**
     * @param $array
     * @param int $n
     * @return array
     */
    public static function getFirstN($array, int $n = 1): array
    {
        $carry = [];
        foreach (range(0, $n - 1) as $i) {
            $carry[] = $array[$i];
        }
        return $carry;
    }

    /**
     * @param $array
     * @param int $n
     * @return array
     */
    public static function getLastN($array, int $n = 1): array
    {
        $carry = [];
        foreach (range($n - 1, 0) as $i) {
            $carry[] = $array[count($array) - $i - 1];
        }
        return $carry;
    }
}
