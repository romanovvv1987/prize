<?php

namespace app\services\prize;

use app\models\Prize;
use app\models\UserPrize;
use app\models\PrizeLoyalty;

class PrizeLoyaltyService extends PrizeServiceAbstract
{
    // TODO: Not implemented yet
    public function generate()
    {
        $model = $this->createPrizeModel(Prize::TYPE_LOYALTY, new PrizeLoyalty());

        $model->amount = rand(PrizeLoyalty::MIN_AMOUNT, PrizeLoyalty::MAX_AMOUNT);
        $model->save(false);
        $model->refresh();

        return $model;
    }

    // TODO: Not implemented yet
    public function refuse($model)
    {
        $model->delete();
    }

    public function findModel($id)
    {
        return PrizeLoyalty::findOne(['id' => $id]);
    }
}