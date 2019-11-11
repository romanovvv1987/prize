<?php

namespace app\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 */
class PrizeProduct extends ActiveRecord
{
    /**
     * @var int
     */
    public $id;

    public static function tableName()
    {
        return '{{%prize_product}}';
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

    /**
     * @return ActiveQueryInterface|Product
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getProducts()
    {
        return Product::findAll([]);
    }
}