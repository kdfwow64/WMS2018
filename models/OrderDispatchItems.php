<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_dispatch_items".
 *
 * @property int $id
 * @property int $parent_order_ID
 * @property string $SKU
 * @property int $quantity
 * @property string $location
 * @property string $status
 * @property int $wave_number
 * @property string $time_printed
 * @property string $date_printed
 */
class OrderDispatchItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_dispatch_items';
    }
    /**connect with OrderDispatch */
    public function getOrderDispatch(){
        return $this->hasOne(OrderDispatch::className(),['id' => 'parent_order_ID']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_order_ID', 'quantity', 'wave_number'], 'integer'],
            [['time_printed', 'date_printed'], 'safe'],
            [['SKU', 'location', 'status'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_order_ID' => 'Parent Order  ID',
            'SKU' => 'SKU',
            'quantity' => 'Quantity',
            'location' => 'Location',
            'status' => 'Status',
            'wave_number' => 'Wave Number',
            'time_printed' => 'Time Printed',
            'date_printed' => 'Date Printed',
        ];
    }
}
