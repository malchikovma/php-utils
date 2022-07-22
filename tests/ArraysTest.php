<?php

use PHPUnit\Framework\TestCase;
use PhpUtils\Arrays;

class ArraysTest extends TestCase
{
    public function testPrioritizeRowsByColumn(): void
    {
        $rows = [
            ['id' => '1', 'name' => 'SEO трафик'],
            ['id' => '19', 'name' => 'Баннерная реклама'],
            ['id' => '3', 'name' => 'Контекстная реклама'],
            ['id' => '4', 'name' => 'Реклама в соц. сетях'],
            ['id' => '2', 'name' => 'Публичные страницы/группы/сообщества в соц. сетях'],
        ];

        $manuallySorted = Arrays::prioritizeRowsByColumn($rows, 'id', [3, 4, 1, 2]);

        $expectedRows = [
            ['id' => '3', 'name' => 'Контекстная реклама'],
            ['id' => '4', 'name' => 'Реклама в соц. сетях'],
            ['id' => '1', 'name' => 'SEO трафик'],
            ['id' => '2', 'name' => 'Публичные страницы/группы/сообщества в соц. сетях'],
            ['id' => '19', 'name' => 'Баннерная реклама'],
        ];
        self::assertEquals($expectedRows, $manuallySorted);
    }

    public function testFindRow(): void
    {
        $rows = [
            ['id' => '1', 'name' => 'SEO трафик'],
            ['id' => '19', 'name' => 'Баннерная реклама'],
            ['id' => '3', 'name' => 'Контекстная реклама'],
            ['id' => '4', 'name' => 'Реклама в соц. сетях'],
            ['id' => '2', 'name' => 'Публичные страницы/группы/сообщества в соц. сетях'],
        ];

        $found = Arrays::findRow($rows, 'id', 19);
        self::assertSame(['id' => '19', 'name' => 'Баннерная реклама'], $found);
    }

    public function testNotFindRow(): void
    {
        $rows = [
            ['id' => '1', 'name' => 'SEO трафик'],
            ['id' => '19', 'name' => 'Баннерная реклама'],
            ['id' => '3', 'name' => 'Контекстная реклама'],
            ['id' => '4', 'name' => 'Реклама в соц. сетях'],
            ['id' => '2', 'name' => 'Публичные страницы/группы/сообщества в соц. сетях'],
        ];

        $found = Arrays::findRow($rows, 'id', 10);
        self::assertNull($found);
    }

    public function testFind()
    {
        self::assertEquals(
            1,
            Arrays::find(function($item) {
                return $item === 1;
            }, [1, 2, 3])
        );

        self::assertEquals(
            2,
            Arrays::find(function($item) {
                return $item === 2;
            }, [1, 2, 3])
        );

        self::assertNull(
            Arrays::find(function($item) {
                return $item === 4;
            }, [1, 2, 3])
        );

        self::assertNull(
            Arrays::find(function($item) {
                // return nothing
            }, [1, 2, 3])
        );
    }

    public function testGetFirstN()
    {
        self::assertEquals([0], range(0, 0));
        self::assertEquals([0, 1], range(0, 1));
        self::assertEquals([1], Arrays::getFirstN([1, 2, 3]));
        self::assertEquals([1, 2], Arrays::getFirstN([1, 2, 3], 2));
        self::assertEquals([1, 2, 3], Arrays::getFirstN([1, 2, 3], 3));
    }

    public function testGetLastN()
    {
        self::assertEquals([0], range(0, 0));
        self::assertEquals([1, 0], range(1, 0));
        self::assertEquals([3], Arrays::getLastN([1, 2, 3]));
        self::assertEquals([2, 3], Arrays::getLastN([1, 2, 3], 2));
        self::assertEquals([1, 2, 3], Arrays::getLastN([1, 2, 3], 3));
    }
}
