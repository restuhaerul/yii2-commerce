<?php
/** @var User $user */
/** @var View $this */
/** @var UserAddress $userAddress */

use common\models\User;
use common\models\UserAddress;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;
use yii\widgets\Pjax;

?>

<?php $addressForm = ActiveForm::begin([
     'id' => 'address-form',
    'action' => ['/site/update-address'],
    'options' => [
        'class' => 'needs-validation',
        'data-pjax' => 1
    ]
]); ?>

<div class="card h-100 text-dark border-secondary">
    <div class="card-header bg-dark text-light border-bottom border-secondary">
        <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Address Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?= $addressForm->field($userAddress, 'address', [
                    'inputOptions' => [
                        'class' => 'form-control text-dark border-secondary',
                        'placeholder' => 'Street Address'
                    ]
                ])->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $addressForm->field($userAddress, 'city', [
                    'inputOptions' => [
                        'class' => 'form-control text-dark border-secondary',
                        'placeholder' => 'City'
                    ]
                ])->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $addressForm->field($userAddress, 'state', [
                    'inputOptions' => [
                        'class' => 'form-control text-dark border-secondary',
                        'placeholder' => 'State/Province'
                    ]
                ])->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $addressForm->field($userAddress, 'country', [
                    'inputOptions' => [
                        'class' => 'form-control text-dark border-secondary',
                        'placeholder' => 'Country'
                    ]
                ])->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $addressForm->field($userAddress, 'zipcode', [
                    'inputOptions' => [
                        'class' => 'form-control text-dark border-secondary',
                        'placeholder' => 'Postal/Zip Code'
                    ]
                ])->textInput() ?>
            </div>
        </div>

        <div class="form-group text-center mt-3">
            <?= Html::submitButton('Update', ['class' => 'btn btn-outline-dark px-4', 'name' => 'update-button']) ?>
            <!--                    <button class="btn btn-outline-dark px-4"><i class="fas fa-map-marked-alt me-2"></i>Update Address</button>-->
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>



