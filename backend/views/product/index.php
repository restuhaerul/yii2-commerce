<?php

use common\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5;

/** @var yii\web\View $this */
/** @var backend\models\search\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var common\models\Product $model */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title ) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'label' => 'Product Image',
                'content' => function ($model) {
                    /** @var \common\models\Product $model */
                    return Html::img($model->getImageUrl(), ['style' => 'width:50px']);
                }
            ],
            [
                'attribute' => 'price',
                'format' => 'raw', // Untuk menampilkan HTML
                'value' => function ($model) {
                return 'Rp. ' . number_format((float)$model->price, 2, ',', '.');
            },
            ],
            [
                'attribute' => 'status',
                'content' => function ($model) {
                        return Html::tag('span', $model->status ? 'Aktif' : 'Tidak',[
                                'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                        ]);
                    }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            //'created_by',
            //'updated_by',
            [
                'class' => 'common\grid\ActionColumn',
            ],
        ],
    ]); ?>


</div>
