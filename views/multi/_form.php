<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderDispatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-dispatch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NS_sales_order')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_method')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_priority')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
