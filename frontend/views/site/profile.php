<?php
use common\models\User;
use common\models\UserAddress;
use yii\web\View;
use yii\widgets\Pjax;

/** @var User $user */
/** @var View $this */
/** @var UserAddress $userAddress */
?>

<div class="row justify-content-center mt-4">
    <!-- Address Information Column -->
    <div class="col-md-6">
        <?= $this->render('user_address', [
                'userAddress' => $userAddress,
        ]) ?>
    </div>

        <!-- Account Information Column -->
        <div class="col-md-6 mb-4">
            <?= $this->render('user_account', [
                'user' => $user
            ]) ?>
        </div>
</div>

