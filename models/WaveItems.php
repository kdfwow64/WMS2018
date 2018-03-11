<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wave_items".
 *
 * @property int $id
 * @property int $parent_wave_number
 * @property int $order_dispatch_id
 * @property int $location_id
 * @property int $bin_location_id
 * @property int $item_id
 * @property int $quantity
 * @property string $license_plate
 * @property string $status
 */
class WaveItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wave_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_wave_number', 'order_dispatch_id', 'location_id', 'bin_location_id', 'item_id', 'quantity'], 'integer'],
            [['license_plate', 'status'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_wave_number' => 'Parent Wave Number',
            'order_dispatch_id' => 'Order Dispatch ID',
            'location_id' => 'Location ID',
            'bin_location_id' => 'Bin Location ID',
            'item_id' => 'Item ID',
            'quantity' => 'Quantity',
            'license_plate' => 'License Plate',
            'status' => 'Status',
        ];
    }
}
