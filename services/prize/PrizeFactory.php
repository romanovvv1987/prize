<?php

namespace app\services\prize;

use app\models\Prize;

class PrizeFactory
{
    public static function getPrize($prizeType)
    {
        switch ($prizeType) {
            case Prize::TYPE_PRODUCT:
                return new PrizeProductService();
            case Prize::TYPE_MONEY:
                return new PrizeMoneyService();
            case Prize::TYPE_LOYALTY:
                return new PrizeLoyaltyService();
            default:
                throw new \Exception('Unknown Prize type');
        }
    }
}