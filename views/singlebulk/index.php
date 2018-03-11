<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SinglePickSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Single Pick Orders(Bulk)';
?>
<div class="order-dispatch-items-index div_align">

    <h3 class="singlebulk_title"><?= Html::encode($this->title) ?></h3>
    
    <?php $form = ActiveForm::begin([
        'id' => 'singlebulk-form',
        'options' => ['class' => 'form-horizontal singlebulk_table'],
    ])
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'grid-view singlebulk_table havenum'],
        'id' => 'grid',
//        'layout' => "{summary}\n{items}\n<div align='left'>{pager}</div>",
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'cssClass' => 'singlebulk_check_css',
                'content' => function ($model,$key,$index,$column) {
                    return '<div class="checkbox checkbox-primary m-r-15">'.$column.'<label for="checkbox"></label></div>';
                },
                'checkboxOptions' => function($model,$key,$index,$widget) {
                    return ['value' => $model['SKU']];
                },
            ],
            ['class' => 'yii\grid\SerialColumn','header' => 'No'],
            ['label' => 'SKU','value' => 'SKU1'],
            ['label' => 'Location','value' => 'location'],
        ],
    ]); 
    ?>
    <input type="hidden" name="singlebulk_flag" id="singlebulk_flag" value="5">
    <?= Html::submitButton('Wave Generation',['class' => 'btn btn-primary']) ?>

    <?php
    ActiveForm::end()
    ?>
</div>
<script type="text/javascript">

    $(document).ready(function(){
         <?php
        $session = Yii::$app->session;
        if(isset($session['checked_array1'])){
            $values = json_encode($session['checked_array1']);
        } else {
            $values =0;
        }
        ?>
        var str = <?php echo $values; ?>;
        console.log(str);
        var ff = 0;
        $('.singlebulk_check_css').each(function(){
            var ss = $(this).closest('tr').children().eq(2).html();
            for(var i =0 ;i<str.length;i++) {
                if(str[i] == ss){
                    $(this).attr('checked','checked');
                }
            }
            if(!$(this).is(':checked')) {
                ff = 1;
            }
        });
        if(ff == 0)
            $('.select-on-check-all').attr('checked','checked');
        $('.singlebulk_check_css').click(function(){
            var sku = $(this).closest('tr').children().eq(2).html();
            var flag = "remove";
            if($(this).is(':checked')) {
                flag = "add";
            }
            $.ajax({
                type: "POST",
                url: '<?php echo Yii::$app->request->baseUrl. '/index.php?r=singlebulk%2Fsample&id=1' ?>',
                data: {
                    sel: sku,
                    flag: flag
                },
                success: function(result){
                //   console.log(result);
                },
                error: function(result) {
                   // alert("failed");
                }
            });
            
        });
        $('.select-on-check-all').click(function(){
            var flag = "remove";
            if($(this).is(':checked')) {
                flag = "add";
            }
            $('.pagination').
            $('.singlebulk_check_css').each(function(){
                var sku = $(this).closest('tr').children().eq(2).html();
                $.ajax({
                    type: "POST",
                    url: '<?php echo Yii::$app->request->baseUrl. '/index.php?r=singlebulk%2Fsample&id=1' ?>',
                    data: {
                        sel: sku,
                        flag: flag
                    },
                    success: function(result){
                    //   console.log(result);
                    },
                    error: function(result) {
                       // alert("failed");
                    }
                });
            });
        });
       
       
    });
</script>


