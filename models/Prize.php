<?php

namespace app\models;

class Prize
{
    const TYPE_MONEY = 'money';

    const TYPE_PRODUCT = 'product';

    const TYPE_LOYALTY = 'loyalty';

    /**
     * @return array
     */
    public static function getAvailableTypes()
    {
        return [
            self::TYPE_MONEY,
            self::TYPE_PRODUCT,
            self::TYPE_LOYALTY,
        ];
    }
}