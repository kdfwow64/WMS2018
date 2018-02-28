<?php 
   use yii\helpers\Html; 
   use yii\widgets\LinkPager;
   $this->title = 'Single Pick Orders';
?> 
<div class="site-single-pic-orders">
	<table border="1">
		<tr>
			<th>ID</th>
			<th>NS</th>
		</tr>
		<?php $i = 0; foreach($models as $field){ ?>   
	    <tr> 
	        <td><?= $field['id']; ?></td>   
	        <td><input type="checkbox" name="" value="<?=$field["NS_sales_order"]?>"><?=$field["NS_sales_order"]?></td>
	    </tr>   
	    <?php } ?>  
	</table>
	<?php
   // display pagination
   echo LinkPager::widget([
      'pagination' => $pagination,
   ]);
?>
	<input type="submit" name="">
</div>


