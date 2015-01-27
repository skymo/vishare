<?php

namespace app\models;

use Yii;
use yii\base\Model;
class CategoriesForm extends Model
{
    public $name;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }
    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function post()
    {
        if ($this->validate()) {
            $data = new Categories();
            $data->name = $this->name;
            $data->save();
            return true;
        } else {
            return false;
        }
    }
}
