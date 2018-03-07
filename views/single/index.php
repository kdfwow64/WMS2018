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

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'single-form',
        'options' => ['class' => 'form-horizontal'],
    ]) 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'grid-view single_gridview'],
//        'layout' => "{summary}\n{items}\n<div align='left'>{pager}</div>",
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\SerialColumn','header' => 'No'],
            [
                'label' => 'ID',
                'attribute' => 'id',
                'value' => 'orderDispatch.id',
            ],
            [
                'label' => 'NS_Sales_Order',
                'attribute' => 'NS_sales_order',
                'value' => 'orderDispatch.NS_sales_order',
            ],
            'SKU',
        ],
    ]); ?>

    <?= Html::submitButton('Wave Generation',['class' => 'btn btn-primary']) ?>
    
    <?php
    ActiveForm::end()
    ?>
</div>