<?php

namespace app\models;

use Yii;
use yii\base\Model;
/**
 * ContactForm is the model behind the contact form.
 */
class VideoForm extends Model
{
    public $name;
    public $email;
    public $body;
    public $verifyCode;

    public static function tableName()
    {
        return 'video';
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }
	
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
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
            $video = new Video();
            $video->name = $this->name;
            $video->email = $this->email;
            $video->body = $this->body;
            $video->save();
            return true;
        } else {
            return false;
        }
    }
}
