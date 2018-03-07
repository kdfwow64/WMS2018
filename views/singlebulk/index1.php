<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SinglePickSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Single Pick Orders(Bulk)';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="order-dispatch-items-index div_align">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'singlebulk-form',
        'options' => ['class' => 'form-horizontal'],
    ])
    ?>
    <select id="sel_location" name="sel_location">
        <?php
        foreach($locations as $location){
        ?>
            <option value="<?=$location['id']?>"><?=$location['warehouse_name']?></option>
        <?php
        }
        ?>
    </select>

    <table class="table table-striped table-bordered single_gridview">
        <thead>
            <tr>
                <th><input type="checkbox" name=""></th>
                <th>No</th>
                <th>SKU</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach($model as $row){
                ?>
                <tr>
                    <td><input type="checkbox" name=""></td>
                    <td><?=++$i?></td>
                    <td><?=$row['SKU']?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <ul class="pagination">
        <li class="prev "><a href="#">«</a></li>
        <li class="next "><a href="#">»</a></li>
    </ul>
    <?= Html::submitButton('Wave Generation',['class' => 'btn btn-primary']) ?>
    
    <?php
    ActiveForm::end()
    ?>
</div>
<script src=""></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#sel_location').change(function(){
            $('#singlebulk-form').submit();
        });
    });
</script>
