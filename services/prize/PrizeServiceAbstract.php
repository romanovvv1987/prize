<?php

namespace app\services\prize;

use app\models\Prize;
use app\models\Product;
use app\models\UserPrize;
use app\models\PrizeProduct;
use app\models\User;
use yii\db\ActiveRecordInterface;


abstract class PrizeServiceAbstract implements PrizeInterface
{
    protected function createPrizeModel($type, ActiveRecordInterface $model)
    {
        $userId = \Yii::$app->getUser()->getId(); // It should be so,
        $userId = 1;                              // but temporary it so

        $userPrizeModel = new UserPrize();
        $userPrizeModel->setIsNewRecord(true);

        $userPrizeModel->setAttribute('prize_type', $type);
        $userPrizeModel->link('user', User::findOne($userId));

        $userPrizeModel->save(false);

        $id = $userPrizeModel->getId();
//        var_dump(UserPrize::findOne($id)); exit;

        $model->link('userPrise', $userPrizeModel);
        $model->save(false);

        return call_user_func([$model, 'findOne'], $model->getPrimaryKey());
    }
}