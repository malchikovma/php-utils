<?php

namespace PhpUtils;

class StringsTimeTokens
{
    public const EN = [
        31536000 => 'Years ago',
        2592000 => 'Months ago',
        604800 => 'Weeks ago',
        86400 => 'Days ago',
        3600 => 'Hours ago',
        60 => 'Minutes ago',
        1 => 'Seconds ago'
    ];

    public const RU = [
        31536000 => 'Лет назад',
        2592000 => 'Месяцев назад',
        604800 => 'Недель назад',
        86400 => 'Дней назад',
        3600 => 'Часов назад',
        60 => 'Минут назад',
        1 => 'Секунд назад'
    ];
}
