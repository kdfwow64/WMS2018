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
class Wavenum2Form extends Model
{
	public $verify1;
	public $wavenum1;
	public $bin1;
    public $item1;
    public $item_id1;
    public $quantity1;
    public function rules()
    {
        return [
            [['wavenum1','bin1','verify1','item1','quantity1','item_id1'], 'required']
        ];
    }
}