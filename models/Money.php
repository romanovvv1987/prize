<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property float   $amount   Amount of money currently presents in our deposit
 */
class Money extends ActiveRecord
{
    public static function tableName()
    {
        return '{{money}}';
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
}