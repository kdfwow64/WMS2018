<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomPickSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Custom Pick Orders';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-dispatch-index div_align">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!--
    <p>
        <?= Html::a('Create Order Dispatch', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'grid-view single_gridview'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => 'No'],

            'id',
            'NS_sales_order',
      //      'shipping_address',
      //      'shipping_method',
      //      'status',
      //      'order_type',
            //'order_priority',
            [
                'label' => 'SKU',
                'attribute' => 'SKU',
                'value' => 'orderDispatchItems.SKU',
        //        'headerOptions' => ['width' => '120'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'headerOptions' => ['width' => '80'],
            ],
        ],
    ]); ?>
</div>
