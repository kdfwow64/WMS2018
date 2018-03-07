<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MultiPickSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-dispatch-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parent_order_ID') ?>

    <?= $form->field($model, 'SKU') ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'wave_number') ?>

    <?php // echo $form->field($model, 'time_printed') ?>

    <?php // echo $form->field($model, 'date_printed') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
