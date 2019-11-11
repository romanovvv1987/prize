<?php

namespace app\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property integer $id
 * @property string  $prize_type    Type of prize (money|product|loyalty)
 * @property boolean $is_received   Does User receive this prize or not
 */
class UserPrize extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_prize}}';
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @return ActiveQueryInterface|User
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return ActiveQueryInterface|PrizeProduct|PrizeMoney|PrizeLoyalty
     * @throws \Exception
     */
    public function getPrize()
    {
        switch ($this->prizeType) {
            case Prize::TYPE_PRODUCT:
                return $this->hasMany(PrizeProduct::class, ['user_prize_id' => 'id']);
            case Prize::TYPE_MONEY:
                return $this->hasOne(PrizeMoney::class, ['user_prize_id' => 'id']);
            case Prize::TYPE_LOYALTY:
                return $this->hasOne(PrizeLoyalty::class, ['user_prize_id' => 'id']);
            default:
                throw new \Exception('Wrong type of prize');
        }
    }
}