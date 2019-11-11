<?php

namespace app\services\prize;

use app\models\Money;
use app\models\Prize;
use app\models\UserPrize;
use app\models\PrizeMoney;

class PrizeMoneyService extends PrizeServiceAbstract
{
    /**
     * TODO: Not checked for workability yet
     *
     * @return int
     * @throws \Exception
     */
    public function generate()
    {
        $model = $this->createPrizeModel(Prize::TYPE_MONEY, new PrizeMoney());
        $model->link('money', Money::find()->one());
        $model->save(false);
        $model->refresh();

        $amount = rand($model->getMinAmount(), $model->getMaxAmount());

        if ($amount == 0) {
            throw new \Exception("No money here");
        }

        $this->moveMoneyToUser($model, $amount);

        return $model;
    }

    /**
     * TODO: Not checked for workability yet
     *
     * @param PrizeMoney $model
     */
    public function refuse($model)
    {
        $transaction = PrizeMoney::getDb()->beginTransaction();

        $moneyModel = $model->getMoney()->one();
        $moneyModel->amount += $model->amount;
        $moneyModel->save(false);

        $model->delete();

        $transaction->commit();
    }

    public function findModel($id)
    {
        return PrizeMoney::findOne(['id' => $id]);
    }

    /**
     * @param PrizeMoney $model
     * @param float $amount
     */
    private function moveMoneyToUser($model, $amount)
    {
        $transaction = PrizeMoney::getDb()->beginTransaction();

        $model->amount = $amount;
        $model->save(false);

        $moneyModel = $model->getMoney()->one();
        $moneyModel->amount -= $amount;
        $moneyModel->save(false);

        $transaction->commit();
    }
}