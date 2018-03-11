<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SinglePickSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Single Pick Orders';
?>
<div class="order-dispatch-items-index div_align">

    <h3 class="singlebulk_title"><?= Html::encode($this->title) ?></h3>

    <?php $form = ActiveForm::begin([
        'id' => 'singlebulk-form',
        'options' => ['class' => 'form-horizontal singlebulk_table'],
    ])
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'grid-view singlebulk_table onlyone'],
//        'layout' => "{summary}\n{items}\n<div align='left'>{pager}</div>",
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'cssClass' => 'usual_check_css',
                'content' => function ($model,$key,$index,$column) {
                    var_dump($model);
                    return '<div class="checkbox checkbox-primary m-r-15">'.$column.'<label for="checkbox"></label></div>';
                },
                'checkboxOptions' => function($model,$key,$index,$widget) {
                    return ['value' => $model['SKU']];
                }
            ],
            ['class' => 'yii\grid\SerialColumn','header' => 'No'],
            ['label' => 'SKU','value' => 'SKU'],
            ['label' => 'Location','value' => 'location'],
        ],
    ]); ?>
    <?= Html::submitButton('Wave Generation',['class' => 'btn btn-primary']) ?>

    <?php
    ActiveForm::end()
    ?>
</div>
