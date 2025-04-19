<?php

use common\models\User;
use common\models\UserAddress;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;
use yii\widgets\Pjax;

/** @var User $user */
/** @var View $this */
/** @var UserAddress $userAddress */


$form = ActiveForm::begin([
    'id' => 'account-form',
    'action' => ['/site/update-account'],
    'options' => [
        'class' => 'needs-validation',
        'data-pjax' => 1
    ]
]); ?>

<div class="card h-100 text-dark border-secondary">
    <div class="card-header bg-dark text-light border-bottom border-secondary">
        <h5 class="mb-0"><i class="fas fa-user-cog me-2"></i>Account Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($user, 'firstname', [
                    'inputOptions' => [
                        'class' => 'form-control text-dark border-secondary',
                        'placeholder' => 'First Name'
                    ]
                ])->textInput(['autofocus' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($user, 'lastname', [
                    'inputOptions' => [
                        'class' => 'form-control text-dark border-secondary',
                        'placeholder' => 'Last Name'
                    ]
                ])->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($user, 'username', [
                    'inputOptions' => [
                        'class' => 'form-control text-dark border-secondary',
                        'placeholder' => 'Username'
                    ]
                ])->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($user, 'email', [
                    'inputOptions' => [
                        'class' => 'form-control text-dark border-secondary',
                        'placeholder' => 'Email Address'
                    ]
                ])->input('email') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($user, 'password', [
                    'inputOptions' => [
                        'class' => 'form-control text-dark border-secondary',
                        'placeholder' => 'Password'
                    ]
                ])->passwordInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($user, 'confirmPassword', [
                    'inputOptions' => [
                        'class' => 'form-control text-dark border-secondary',
                        'placeholder' => 'Confirm Password'
                    ]
                ])->passwordInput() ?>
            </div>
        </div>

        <div class="form-group text-center mt-3">
            <?= Html::submitButton('<i class="fas fa-save me-2"></i>Update Account', [
                'class' => 'btn btn-outline-dark px-4',
                'name' => 'update-button'
            ]) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php
$js = <<<JS
// Fungsi notifikasi yang sama
window.showAlert = function(message, type='success') {
    const alert = $(`
        <div class="fixed-top w-25 mx-auto mt-3 \${type === 'error' ? 'bg-danger' : 'bg-dark'} text-white p-3 rounded" 
             style="z-index: 9999; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
            <div class="d-flex justify-content-between align-items-center">
                <span>\${message}</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close"></button>
            </div>
        </div>
    `).hide().appendTo('body').fadeIn();
    
    alert.find('.btn-close').on('click', function() {
        alert.fadeOut();
    });
    
    setTimeout(() => alert.fadeOut(() => alert.remove()), 3000);
}

// Handle submission untuk kedua form
$(document).on('beforeSubmit', '#address-form, #account-form', function(e) {
    e.preventDefault();
    const form = $(this);
    const isAddressForm = form.attr('id') === 'address-form';
    
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {
            if (response && response.status) {
                // Tampilkan pesan yang sesuai berdasarkan form
                const successMessage = isAddressForm 
                    ? (response.message || 'Address information berhasil diupdate!')
                    : (response.message || 'Account information berhasil diupdate!');
                
                showAlert(successMessage, response.status);
                
                if (response.refresh) {
                    setTimeout(() => location.reload(), 2000);
                }
            }
        },
        error: function(xhr) {
            const errorMsg = xhr.responseJSON && xhr.responseJSON.message 
                ? xhr.responseJSON.message 
                : (isAddressForm 
                    ? 'Terjadi kesalahan saat mengupdate address' 
                    : 'Terjadi kesalahan saat mengupdate account');
            showAlert(errorMsg, 'error');
        }
    });
    
    return false;
});
JS;

$this->registerJs($js, View::POS_END);
?>