<?php

namespace app\services\prize;

use app\models\Prize;
use app\models\Product;
use app\models\UserPrize;
use app\models\PrizeProduct;

class PrizeProductService extends PrizeServiceAbstract
{
    // TODO: Not checked for workability yet
    public function generate()
    {
        $model = $this->createPrizeModel(Prize::TYPE_PRODUCT, new PrizeProduct());
        $products = $model->getProducts();

        if (count($products)) {
            $item = rand(0, (count($products)-1));

            /** @var Product $product */
            $product = $products[$item];

            $model->link('product', $product);
            $model->save(false);

            $product->is_reserved = true;
            $product->save(false);

            return $product;
        }

        return $model;
    }

    // TODO: Not implemented yet
    public function refuse($model)
    {
        $model->delete();
    }

    public function findModel($id)
    {
        return PrizeProduct::findOne(['id' => $id]);
    }
}