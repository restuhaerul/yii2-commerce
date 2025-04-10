<?php
use yii\helpers\StringHelper;
/** @var \common\models\Product $model */
?>


    <div class="card h-100">
        <a href="">
            <img class="card-img-top" src="<?php echo $model->getImageUrl()?>" alt="">
        </a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="#"><?php echo \yii\helpers\StringHelper::truncateWords($model->name, 20) ?></a>
            </h4>
            <h5><?php echo $model->getPriceInRupiah() ?></h5>
            <div class="card-text">
                <?php echo $model->getShortDescription() ?>
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="#" class="btn btn-primary">
                Add to Cart
            </a>
        </div>
    </div>

