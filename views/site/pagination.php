<?php
   use yii\widgets\LinkPager;
?>
<?php foreach ($models as $model): ?>
   <?= $model['id']; ?>
   <?= $model['NS_sales_order']; ?>
   <br/>
<?php endforeach; ?>
<?php
   // display pagination
   echo LinkPager::widget([
      'pagination' => $pagination,
   ]);
?>