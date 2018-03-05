<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderDispatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Single Pick Orders';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-dispatch-index div_align">

   <h1><?= Html::encode($this->title) ?></h1>
 <!--    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order Dispatch', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'grid-view single_gridview'],
//        'tableOptions' => ['class' => 'table table-striped table-bordered single_table'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => 'No'],

            'id',
            'NS_sales_order',
        //    'order_type',
            [
                'label' => 'SKU',
                'attribute' => 'SKU',
                'value' => 'orderDispatchItems.SKU',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'headerOptions' => ['width' => '80'],
            ],
        ],
    ]);
    ?>
</div>
