<?php

namespace app\services;

use app\models\Prize;
use app\models\PrizeLoyalty;
use app\models\PrizeMoney;
use app\models\PrizeProduct;
use app\models\UserPrize;
use app\services\prize\PrizeFactory;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * Service that generates a prize
 */
class PrizeService
{
    /**
     * Prize type (money|products|loyalty points)
     *
     * @var string
     */
    private $prizeType;

    /**
     * Prize model
     *
     * @var PrizeMoney|PrizeLoyalty|PrizeProduct
     */
    private $prizeValue;

    /**
     * @var UserPrize
     */
    private $model;

    /**
     * Generates a prize
     */
    public function generate()
    {
        $this->generatePrizeType();
        $this->generatePrizeValue();
    }

    /**
     * Refuses a prize
     */
    public function refuse($id)
    {
        /** @var UserPrize $model */
        if (!$model = $this->findModel($id)) {
            throw new NotFoundHttpException('Model not found');
        }

        PrizeFactory::getPrize($model->prize_type)->refuse($model);
    }

    public function getPrizeType()
    {
        return $this->prizeType;
    }

    public function getPrizeValue()
    {
        return $this->prizeValue;
    }

    private function findModel($id)
    {
        return UserPrize::find()->where(['id' => (int)$id])->one();
    }

    private function generatePrizeType()
    {
        $prizeTypes = Prize::getAvailableTypes();
        $item = rand(0, (count($prizeTypes)-1));

        $this->prizeType = $prizeTypes[$item];
    }

    private function generatePrizeValue()
    {
        $service = PrizeFactory::getPrize($this->prizeType);
        $this->prizeValue = $service->generate();
    }
}
