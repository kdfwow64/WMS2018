<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use Picqer\Barcode;

/* @var $this yii\web\View */
/* @var $model frontend\modules\salary\models\Salary */
//@var $model yii\base\Model
//@var $totaldays any

//$this->title = $model->s_id;
$this->title = 'Wave';
?>
<div class="salary-view">

    <h1><?= Html::encode($this->title)?>   <?=  $wavenum?></h1>
    <div style="width: 180px;height: 45px;padding-left: 10px;padding-top: 10px;padding-right: 10px;border-style: solid;  border-width: 2px;margin-bottom: 10px;">

    <?php
      $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
      echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($wavenum, $generator::TYPE_CODE_128)) . '">';
    ?>
    <span style="letter-spacing: 7px;">    <?=   $wavenum?></span>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'grid-view'],
        'layout' => '{items}',
//        'layout' => "{summary}\n{items}\n<div align='left'>{pager}</div>",
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn','header' => 'No'],
            ['label' => 'Order Number','value' => 'NS_sales_order'],
            ['label' => 'SKU','value' => 'SKU'],
            ['label' => 'Quantity','value' => 'quantity'],
            ['label' => 'Customer Name','value' => 'customer'],
            ['label' => 'Address','value' => 'addr1'],
            ['label' => 'Warehouse','value' => 'location'],
            ['label' => 'Pick Location','value' => 'pic'],

        ],
    ]); ?>

</div>

