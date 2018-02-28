<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderDispatch */
/* @var $form ActiveForm */
?>
<div class="single">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'order_priority') ?>
        <?= $form->field($model, 'NS_sales_order') ?>
        <?= $form->field($model, 'shipping_address') ?>
        <?= $form->field($model, 'shipping_method') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'order_type') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- single -->
