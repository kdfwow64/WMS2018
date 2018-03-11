<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="wave2_body">
<?php $form = ActiveForm::begin(); ?>
	<h1 class="wave2_h1 align_center">Wave #<?= Html::encode($model->wavenum) ?></h1>
	<h4 class="wave2_h4">First Pick Location:</h4>
	<h4 class="wave2_h4 align_center" style="font-weight: bold;"><?= Html::encode($model->bin) ?></h4>
	<h4 class="wave2_h4">Scan bin location to verify:</h4>
    <?= $form->field($model, 'verify',['inputOptions' => ['autofocus' => 'autofocus']])->label(false) ?>
    <?= $form->field($model, 'wavenum')->hiddenInput(['value'=> $model->wavenum])->label(false) ?>
    <?= $form->field($model, 'bin')->hiddenInput(['value'=> $model->bin])->label(false) ?>
    <?= $form->field($model, 'item_id')->hiddenInput(['value'=> $model->item_id])->label(false) ?>
    <?= $form->field($model, 'quantity')->hiddenInput(['value'=> $model->quantity])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary wave2_sub']) ?>
    </div>
<?php ActiveForm::end(); ?>
</div>


<style type="text/css">
.wave2_h1 {
	margin-bottom: 25px;
}

.align_center {
    text-align: center;
}
.wave2_h4 {
	margin-bottom: 15px;
}
.wave2_body {
	padding: 25px 30px;
    width: 400px;
    height: 500px;
    margin: auto;
    border-radious: 2px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
@media only screen and (max-width: 440px) {
    .wave2_body {
        padding: 8vw 8vw;
        width: 90vw;
    }
}
#wavenum1form-verify{
    width: 220px;
    margin: auto;
    margin-top: 30px;
}

.wave2_sub {	
	margin-left: 130px;
	margin-top: 10px;
}
</style>