<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderDispatchItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-dispatch-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_order_ID')->textInput() ?>

    <?= $form->field($model, 'SKU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wave_number')->textInput() ?>

    <?= $form->field($model, 'time_printed')->textInput() ?>

    <?= $form->field($model, 'date_printed')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
