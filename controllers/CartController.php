<?php

namespace app\controllers;
use app\models\Good;
use app\models\Cart;
use Yii;
use yii\web\Controller;
class CartController extends Controller
{
    public function actionDelete($id) {
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart -> recalcCart($id);
        return $this->renderPartial('cart', compact( 'session'));
    }
    public function actionClear() {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.totalQuantity');
        $session->remove('cart.totalSum');
        return $this->renderPartial('cart', compact( 'session'));
    }

    public function actionOpen() {
        $session = Yii::$app->session;
        $session->open();
        return $this->renderPartial('cart', compact( 'session'));
    }

    public function actionAdd($name) {
        $good = new Good();
        $good = $good->getOneGood($name);
        $session = Yii::$app->session;
        $session->open();
        // $session->remove('cart');
        $cart = new Cart();
        $cart->addToCart($good);
    return $this->renderPartial('cart', compact('good', 'session'));
    }

}