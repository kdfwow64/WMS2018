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

    <h1><?= Html::encode($this->title) ?></h1>

    
    <select id="sel_location" name="sel_location">
        <?php
        foreach($locations as $location){
        ?>
            <option value="<?=$location['id']?>"><?=$location['warehouse_name']?></option>
        <?php
        }
        ?>
    </select>
    <?php $form = ActiveForm::begin([
        'id' => 'singlebulk-form',
        'options' => ['class' => 'form-horizontal bulk_table'],
        'action' => Yii::$app->urlManager->createAbsoluteUrl(['singlebulk/wave']),
    ])
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'grid-view table_height'],
//        'layout' => "{summary}\n{items}\n<div align='left'>{pager}</div>",
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'cssClass' => 'check_css',
                'checkboxOptions' => function($model,$key,$index,$widget) {
                    return ['value' => $model['SKU']];
                }
            ],
            ['class' => 'yii\grid\SerialColumn','header' => 'No'],
            ['label' => 'SKU','value' => 'SKU1'],
        ],
    ]); ?>
    <?= Html::submitButton('Wave Generation',['class' => 'btn btn-primary']) ?>
<!--
    <?= Html::a('Wave Generation',['/singlebulk/wave'],['class' => 'btn btn-primary']) ?>
-->
    <?php
    ActiveForm::end()
    ?>
</div>

<script type="text/javascript">
    //notifyjs.com
    $(document).ready(function(){
        $('#sel_location').change(function(){
            $('#singlebulk-form').submit();
        });
        $('.check_css').click(function(){
            var selected_count = $('input[type="checkbox"]:checked').length;
            var total_count = 0;
            $('input[type="checkbox"]:checked').each(function()
            {
                var ss = $(this).parent().next().next().html();
                start = ss.search('\\(');
                end = ss.search('\\)');
                ss = ss.slice(start+1,end);
                total_count = total_count + parseInt(ss);
            });
            
            var str = selected_count+" items selected(total:" +total_count+")";
            $('.notifyjs-corner').empty();
            var noteOption = {
                // whether to hide the notification on click
                clickToHide : true,
                // whether to auto-hide the notification
                autoHide : false,
//                position : '0',
                globalPosition : 'top center',
                // default style
                style : 'bootstrap',
                // default class (string or [string])
                className : 'error',
                // show animation
                showAnimation : 'slideDown',
                // show animation duration
                showDuration : 200,
                // hide animation
                hideAnimation : 'slideUp',
                // hide animation duration
                hideDuration : 200,
                // padding between element and notification
                gap : 20,
                autoHide : true,
                autoHideDelay : 2000
            }
            $.notify.defaults(noteOption);
            $.notify.addStyle('happyblue', {
              html: "<div><span data-notify-text/></div>",
              classes: {
                base: {
                  "white-space": "nowrap",
                  "background-color": "#333399",
                  "padding": "10px",
                  "margin-top" : "45px",
                  "border-radius" : "5px"
                },
                superblue: {
                  "color": "white",
                }
              }
            });
            $.notify(str,{style:'happyblue',className:'superblue'});

        });
    });
</script>


<!--
Html::button("<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>",
                    ['class'=>'kv-action-btn',
                        'onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/create','id'=>$model->id]) . "';",
                        'data-toggle'=>'tooltip',
                        'title'=>Yii::t('app', 'Create New Record'),
                    ]
                )
    -->