<?php
/** @var \common\models\Product $model */
?>


<div class="col mb-5 p-2">
	<div class="card">
		<!-- Product image-->
		<img class="card-img-top" style="width: 100%" src="<?php echo $model->getImageUrl(); ?>" alt="..." />
		<!-- Product details-->
		<div class="card-body">
			<div class="text-center">
				<!-- Product name-->
				<h5 class="fw-bolder"><?php echo $model->name ?></h5>
				<!-- Product reviews-->

				<!-- Product price-->
				<?php echo Yii::$app->formatter->asCurrency($model->price); ?>
			</div>
            <div class="card-text mt-4">
              <?php echo \yii\helpers\StringHelper::truncateWords($model->description, 25) ?>
            </div>
		</div>
		<!-- Product actions-->
		<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
			<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
		</div>
	</div>
</div>