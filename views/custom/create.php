<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderDispatch */

$this->title = 'Create Order Dispatch';
$this->params['breadcrumbs'][] = ['label' => 'Order Dispatches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-dispatch-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
