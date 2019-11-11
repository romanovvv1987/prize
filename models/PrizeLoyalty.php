<?php

namespace app\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property float   $amount   Amount of loyalty points winned by User but not merged with User's loyalty points yet.
 *                             It amount stored here because User may refuse to receive the prize.
 *                             If it happens the loyalty points will erased.
 */
class PrizeLoyalty extends ActiveRecord
{
    const MIN_AMOUNT = 1;

    const MAX_AMOUNT = 100;

    /**
     * Rate to exchange Money to Loyalty
     */
    const EXCHANGE_RATE = 10;

    public static function tableName()
    {
        return '{{%prize_loyalty}}';
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @return ActiveQueryInterface|UserPrize
     */
    public function getUserPrise()
    {
        return $this->hasOne(UserPrize::class, ['id' => 'user_prize_id']);
    }
}