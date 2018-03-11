<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="wave3_body">
	<?php $form = ActiveForm::begin(); ?>
		<h1 class="wave3_h1 align_center">Wave #<?= Html::encode($model->wavenum1) ?></h1>
		<h4 class="wave3_h4">You are now at:</h4>
		<h4 class="wave3_h4 align_center"><?= Html::encode($model->bin1) ?></h4>
		<h4 class="wave3_h4">The first item to pick from this bin is:</h4>
		<h4 class="wave3_h4 align_center"><?= Html::encode($model->item1) ?></h4>
		<h4 class="wave3_h4">You need to pick a quantity of:</h4>
		<h4 class="wave3_h4 align_center"><?= Html::encode($model->quantity1) ?></h4>
		<h4 class="wave3_h4">Enter item to verify</h4>
	    <?= $form->field($model, 'verify1',['inputOptions' => ['autofocus' => 'autofocus']])->label(false) ?>
	    <?= $form->field($model, 'wavenum1')->hiddenInput(['value'=> $model->wavenum1])->label(false) ?>
	    <?= $form->field($model, 'bin1')->hiddenInput(['value'=> $model->bin1])->label(false) ?>
	    <?= $form->field($model, 'item1')->hiddenInput(['value'=> $model->item1])->label(false) ?>
	    <?= $form->field($model, 'item_id1')->hiddenInput(['value'=> $model->item_id1])->label(false) ?>
	    <?= $form->field($model, 'quantity1')->hiddenInput(['value'=> $model->quantity1])->label(false) ?>

	    <div class="form-group">
	        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary wave3_sub']) ?>
	    </div>
	<?php ActiveForm::end(); ?>
</div>


<style type="text/css">
.align_center {
	text-align: center;
}
.wave3_body {
	padding: 25px 30px;
    width: 400px;
    height: 500px;
    margin: auto;
    border-radious: 2px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
@media only screen and (max-width: 440px) {
    .wave3_body {
        padding: 8vw 8vw;
        width: 90vw;
    }
    h4 {
    	font-size: 4.6vw;
    }
}

.wave3_h1 {
	margin-bottom: 25px;
}

.wave3_h4 {
	margin-bottom: 15px;
}

#wavenum2form-verify{
    width: 220px;
    margin: auto;
    margin-top: 30px;
}

.wave3_sub {	
	margin-left: 130px;
	margin-top: 10px;
}
</style>