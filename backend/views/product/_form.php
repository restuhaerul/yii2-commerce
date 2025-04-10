<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

    <div class="product-form">

        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->widget(\dosamigos\ckeditor\CKEditor::classname(), [
            'options' => ['rows' => 6],
            'preset' => 'basic'
        ]) ?>

        <?= $form->field($model, 'imageFile', [
            'template' => '
            <div class="custom-file">
            {input}
            {label}
            {error}
            </div>',
            'labelOptions' => ['class' => 'custom-file-label'],
            'inputOptions' => ['class' => 'custom-file-input'],
        ])->textInput(['type' => 'file']) ?>

        <!-- Input Price -->
        <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'id' => 'price-input']) ?>

        <!-- Label dan Tampilan Harga Rupiah -->
        <!-- Result: Formatted Price -->
        <div class="mb-3">
            <label class="form-label">Result (Rupiah)</label>
            <p id="formatted-price" class="text-success fw-bold fs-4">
                <?= Html::encode($model->price ? $model->getPriceInRupiah() : 'Rp 0') ?>
            </p>
        </div>


        <?= $form->field($model, 'status')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <!-- Script JavaScript untuk Memformat Harga Secara Real-Time -->
<?php
$this->registerJs(<<<JS
$(document).ready(function () {
    const priceInput = $('#price-input'); // Input field untuk harga
    const formattedPrice = $('#formatted-price'); // Elemen untuk menampilkan harga Rupiah

    // Fungsi untuk memformat angka menjadi Rupiah menggunakan Accounting.js
    function formatToRupiah(value) {
        return accounting.formatMoney(value, "Rp. ", 2, ".", ",");
    }

    // Event listener untuk mendeteksi perubahan pada input harga
    priceInput.on('input', function () {
        const rawValue = priceInput.val().replace(/[^0-9]/g, ''); // Hapus karakter non-numerik
        priceInput.val(rawValue); // Update nilai input dengan angka saja
        formattedPrice.text(formatToRupiah(rawValue)); // Format dan tampilkan harga Rupiah
    });

    // Inisialisasi harga Rupiah saat halaman dimuat
    formattedPrice.text(formatToRupiah(priceInput.val()));
});
JS);
?>