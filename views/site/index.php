<?php

/* @var $this yii\web\View */
$this->title = 'WMS';
$session = Yii::$app->session;
if(isset($_SESSION['user_id']))
{
    echo "string1";
 //   Yii::$app->runAction('SiteController/site/workflowprocessingwaves');
}
else
{
    echo "asf";
 //   Yii::$app->runAction('SiteController/site/login');
}
?>

