<?php

namespace app\models;

use Yii;
use yii\base\Model;
/**
 * ContactForm is the model behind the contact form.
 */
class PublishForm extends Model
{
    public $title;
    public $preview;
    public $embed;
	public $description;
    public $category;
    public $featured;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title', 'preview', 'description', 'embed', 'category', 'featured'], 'required'],
        ];
    }
	
    public function post()
    {
        if ($this->validate()) {
            $data = new Data();
            $data->title = $this->title;
            $data->preview = $this->preview;
			$data->description = $this->description;
            $data->embed = $this->embed;
			$data->category = $this->category;
			$data->featured = $this->featured;
            $data->date = date("Y-m-d");
            $data->save();
            return true;
        } else {
            return false;
        }
    }
}
