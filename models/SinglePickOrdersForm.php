<?php
namespace app\models;   
   
use Yii;   
   
class SinglePickOrdersForm extends \yii\db\ActiveRecord   
{   
    /**  
     * @inheritdoc  
     */   
    public static function tableName()
    {   
        return 'order_dispatch';
    }   
       
    /**  
     * @inheritdoc
     */   
    public function rules()
    {   
        return [   
            [['id', 'NS_sales_order'], 'required']
        ];   
    }
}  