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
}
