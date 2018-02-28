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
class WavenumForm extends Model
{
	public $wavenum;
    public function rules()
    {
        return [
            ['wavenum', 'required']
        ];
    }
}