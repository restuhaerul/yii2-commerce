<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>

<div class="row">
    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
            </div>
            <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                'options' => ['class' => 'user']
                ]); ?>

            <?= $form->field($model, 'username',[
                    'inputOptions' => [
                            'class' => 'form-control form-control-user',
                            'placeholder' => 'Masukan username anda'
                    ]
            ])->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password',[
                    'inputOptions' => [
                            'class' => 'form-control form-control-user',
                            'placeholder' => 'Masukan password anda'
                    ]
            ])->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>


            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>

            <?php ActiveForm::end(); ?>
            <hr>
            <div class="text-center">
                <a class="small" href="<?php echo \yii\helpers\Url::to(['/site/forgot-password']) ?>">Lupa Password?</a>
            </div>
            <div class="text-center">
                <a class="small" href="register.html">Buat Akun Baru!</a>
            </div>
        </div>
    </div>
</div>