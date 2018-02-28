<?php

namespace app\models;

use Yii;
use app\models\OrderDispatchItems;

/**
 * This is the model class for table "order_dispatch".
 *
 * @property int $id
 * @property string $NS_sales_order
 * @property string $shipping_address
 * @property string $shipping_method
 * @property string $status
 * @property string $order_type
 * @property int $order_priority
 */
class OrderDispatch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public static function tableName()
    {
        return 'order_dispatch';
    }

    public function getOrderDispatchItems(){
        return $this->hasOne(OrderDispatchItems::className(),['parent_order_ID' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_priority'], 'integer'],
            [['NS_sales_order', 'shipping_address', 'shipping_method', 'status', 'order_type'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'NS_sales_order' => 'Ns Sales Order',
            'shipping_address' => 'Shipping Address',
            'shipping_method' => 'Shipping Method',
            'status' => 'Status',
            'order_type' => 'Order Type',
            'order_priority' => 'Order Priority',
        ];
    }
}
