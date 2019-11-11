<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string  $name          Name of product
 * @property boolean $is_reserved   When User win this product, it product marks as reserver and doen't participating in lottery.
 *                                   If User receives this product, the product will be deleted.
 *                                   If User refuse to receive, the product will be unmarked as reserved.
 */
class Product extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
}