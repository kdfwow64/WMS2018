<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="wave4_body">
<?php $form = ActiveForm::begin(); ?>
	<h1 class="wave4_class">Wave #<?= Html::encode($model->wavenum) ?></h1>
	<h4 class="wave4_class">Please enter a License Plate for this</h4>

    <?= $form->field($model, 'verify')->input('verify',['placeholder' =>'Enter LP here'])->label(false) ?>
    <br>
    <div class="form-group">
        <?= Html::button('Submit', ['class' => 'btn btn-primary wave4_sub']) ?>
    </div>
<?php ActiveForm::end(); ?>
</div>


<style type="text/css">
.wave4_body {
	padding: 25px 30px;
    width: 400px;
    height: 330px;
    margin: auto;
    border-radious: 2px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

@media only screen and (max-width: 440px) {
    .wave4_body {
        padding: 10vw 10vw;
        width: 90vw;
    }
    h4 {
        line-height: 25px;
    }
}

.wave4_class {
    text-align: center;margin-bottom: 35px;
}


#wavenum2form-verify{
    width: 220px;
    margin: auto;
    margin-top: 30px;
}

.wave4_sub {	
	margin-left: 130px;
}
</style>