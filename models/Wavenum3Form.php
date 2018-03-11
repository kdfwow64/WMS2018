<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Wavenum3Form extends Model
{
	public $wavenum2;
	public $bin2;
    public $item2;
    public $item_id2;
    public $quantity2;
    public $plate;
    public function rules()
    {
        return [
            ['plate','safe'],
            [['wavenum2','bin2','item2','quantity2','item_id2'], 'required']
        ];
    }
}