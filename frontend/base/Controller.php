<?php

namespace frontend\base;

use common\models\CartItems;

class Controller extends \yii\web\Controller {
	public function beforeAction($action) {
		$this->view->params['cartItemCount'] = CartItems::findBySql("
				Select SUM(quantity)
				FROM cart_items
				WHERE created_By = :userId", ['userId' => \Yii::$app->user->id])->scalar();
		return parent::beforeAction($action);
	}
}