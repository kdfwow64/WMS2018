<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WaveitemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wave Items';
?>
<div class="wave-items-index div-align">

    <h3 class="singlebulk_title"><?= Html::encode($this->title) ?></h3>

    <?php $form = ActiveForm::begin([
        'id' => 'waveitems-form',
        'options' => ['class' => 'form-horizontal waveitems_table'],
    ])
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'grid-view waveitems_table'],
//        'layout' => "{summary}\n{items}\n<div align='left'>{pager}</div>",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => 'No'],
            ['label' => 'Wave Number','value' => 'wave_number'],
            ['label' => 'Total SKUs','value' => 'SKU_count'],
            ['label' => 'Total Quantities','value' => 'quantities'],
/*            [
                'header' => 'Print',
                'content' => function($url,$model,$key) {
                    $id = $model['wave_number'];
                        return Html::a('Print',['waveitems/print',['wavenum' => $model['wave_number1']]],['class' => 'btn btn-primary']);
                    }
            ]*/
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Print',
                'template' => '{print}',
                'buttons' => [
                    'print' => function($url,$model) {
                        return Html::a('<span class="btn btn-primary">Print</span>',$url,['title' => Yii::t('app','print'),'target' => '_blank']);
                    }
                ],
                'urlCreator' => function($action,$model,$key,$index) {
                    if($action === 'print') {
                        $url = 'index.php?r=waveitems%2Fprint&id='.$model['wave_number'];
                        return $url;
                    }
                }
            ]

        ],
    ]); ?>

    <?php
    ActiveForm::end()
    ?>
</div>
