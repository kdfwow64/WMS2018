<?php

namespace app\models;

use Yii;

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
 * @property string $addr1
 * @property string $addr2
 * @property string $addr3
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_priority'], 'integer'],
            [['addr2', 'addr3', 'city', 'state', 'zip', 'country'], 'required'],
            [['NS_sales_order', 'shipping_address', 'shipping_method', 'status', 'order_type', 'addr1', 'addr2', 'addr3', 'city', 'state', 'zip', 'country'], 'string', 'max' => 200],
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
            'addr1' => 'Addr1',
            'addr2' => 'Addr2',
            'addr3' => 'Addr3',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'country' => 'Country',
        ];
    }
}
