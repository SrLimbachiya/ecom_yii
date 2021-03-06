<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
	    <?php echo \yii\widgets\ListView::widget([
		    'dataProvider' => $dataProvider,
            'layout' => '{summary}<br><div class="row">{items}</div><br>{pager}',
		    'itemView' => '_product_item',
            'options' => [
                    'class' => 'row'
            ],
            'itemOptions' => [
                    'class' => 'col-lg-4 col-md-6 mb-4 product-items'
            ],
            'pager' => [
                  'class' => \yii\bootstrap4\LinkPager::class
            ]
	    ]); ?>
    </div>
</div>
