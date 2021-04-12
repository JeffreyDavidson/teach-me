<?php

namespace App\Models;

class Term
{
    public static $list = [
        'Spring',
        'Summer',
        'Fall',
    ];

    public static function allForDropdown()
    {
        $items = [];
        $items[0] = 'Please select a term';

        foreach (self::$list as $listItem) {
            $items[$listItem] = $listItem;
        }

        return $items;
    }
}
