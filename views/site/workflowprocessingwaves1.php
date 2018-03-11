<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="wave1_body">
<?php $form = ActiveForm::begin(); ?>
	<h4>Enter Wave Number:</h4>

    <?= $form->field($model, 'wavenum',['inputOptions' => ['autofocus' => 'autofocus']])->textInput(['type' => 'number'])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary wave1_sub']) ?>
    </div>
<?php ActiveForm::end(); ?>
</div>

<style type="text/css">
.wave1_body {
	padding: 50px 50px;
    width: 400px;
    height: 300px;
    margin: auto;
    border-radius: 2px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

@media only screen and (max-width: 440px) {
    .wave1_body {
        padding: 10vw 10vw;
        width: 90vw;
    }
}

#wavenumform-wavenum {
    width: 220px;
    margin: auto;
    margin-top: 30px;
}

.wave1_sub {	
	margin-left: 120px;
	margin-top: 30px;
}
</style>
