<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WaveItems */

$this->title = 'Create Wave Items';
$this->params['breadcrumbs'][] = ['label' => 'Wave Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wave-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
