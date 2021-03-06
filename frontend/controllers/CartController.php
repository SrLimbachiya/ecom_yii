<?php

namespace frontend\controllers;

use common\models\CartItems;
use common\models\Product;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CartController extends \frontend\base\Controller {

	public function behaviors() {
		return [
			[
				'class' => ContentNegotiator::class,
				'only' => ['add'],
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
				],
			]
		];
	}

	public function actionIndex() {
		if (\Yii::$app->user->isGuest) {
			// get
		} else {
			$cartItems = CartItems::findBySql("
					SELECT
						c.product_id as id,
						p.image,
						p.name,
						p.price,
						c.quantity,
						p.price * c.quantity as total_price
					FROM cart_items c
						LEFT JOIN products p on p.id = c.product_id
					WHERE c.created_by = :userId",
				['userId' => \Yii::$app->user->id])->asArray()->all();
		}

		return $this->render('index', [
			'items' => $cartItems
		]);
	}

	public function actionAdd() {
		$id = \Yii::$app->request->post('id');
		$product = Product::find()->id($id)->published()->one();

		if (!$product) {
			throw new NotFoundHttpException('Product does not exist');
		}

		if (\Yii::$app->user->isGuest) {
			// save in session
		} else {
			$userId = \Yii::$app->user->id;
			$cartItem = CartItems::find()->userId($userId)->productId($id)->one();
			if ($cartItem) {
				$cartItem->quantity++;
			} else {
				$cartItem = new CartItems();
				$cartItem->product_id = $id;
				$cartItem->created_by = \Yii::$app->user->id;
				$cartItem->quantity = 1;
			}

			if ($cartItem->save()) {
				return [
					'success' => true
				];
			} else {
				return [
					'success' => false,
					'errors' => $cartItem->errors
				];
			}
		}
	}

}