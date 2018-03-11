<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WaveItems */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wave Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wave-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_wave_number',
            'order_dispatch_id',
            'location_id',
            'bin_location_id',
            'item_id',
            'quantity',
            'license_plate',
            'status',
        ],
    ]) ?>

</div>
