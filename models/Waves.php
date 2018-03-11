<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "waves".
 *
 * @property int $id
 * @property int $wave_number
 * @property string $time_printed
 * @property string $date_printed
 * @property int $number_order_dispatch_in_wave
 * @property string $picked_by
 * @property string $wave_status
 * @property string $date_completed
 * @property string $exception_code
 * @property string $printed_timestamp
 */
class Waves extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'waves';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wave_number', 'number_order_dispatch_in_wave'], 'integer'],
            [['time_printed', 'date_printed', 'printed_timestamp'], 'safe'],
            [['picked_by', 'wave_status', 'date_completed', 'exception_code'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wave_number' => 'Wave Number',
            'time_printed' => 'Time Printed',
            'date_printed' => 'Date Printed',
            'number_order_dispatch_in_wave' => 'Number Order Dispatch In Wave',
            'picked_by' => 'Picked By',
            'wave_status' => 'Wave Status',
            'date_completed' => 'Date Completed',
            'exception_code' => 'Exception Code',
            'printed_timestamp' => 'Printed Timestamp',
        ];
    }
}
