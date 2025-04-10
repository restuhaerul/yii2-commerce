<?php

/** @var yii\web\View $this */
/** @var ActiveDataProvider $dataProvider*/

use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <?php echo ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{summary}<div class="row">{items}</div>{pager}',
            'itemView' => '_product_item',
            'itemOptions' => [
                    'class' => 'col-lg-3 col-md-6 mb-4',
            ],
            'pager' => [
                    'class' => \yii\bootstrap5\LinkPager::class
            ]
        ])?>

    </div>
</div>
