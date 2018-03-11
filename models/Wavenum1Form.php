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
class Wavenum1Form extends Model
{
	public $wavenum;
	public $verify;
	public $bin;
	public $item_id;
	public $quantity;
    public function rules()
    {
        return [
            [['wavenum','verify','bin','item_id','quantity'], 'required']
        ];
    }
}