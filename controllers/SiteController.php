<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\VideoForm;
use app\models\Video;
use app\models\Data;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use app\models\Categories;
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
		$categories = Categories::findBySql('SELECT * FROM categories')->all();
		$query = Data::find();
$pagination = new Pagination([
'defaultPageSize' => 5,
'totalCount' => $query->count(),
]);

$videos = $query->orderBy('id desc')
->offset($pagination->offset)
->limit($pagination->limit)
->all();
$featured = Data::findBySql("SELECT * FROM `data` WHERE `featured`='1' ORDER BY id DESC LIMIT 1")->one();
        return $this->render('index', [
                'categories' => $categories,
				'videos' => $videos,
                'pagination' => $pagination,
				'featured' => $featured,
            ]);
    }
    public function actionCategory($id)
    {
		$catname = Categories::findBySql('SELECT * FROM categories WHERE id='.$id)->one();
		$categories = Categories::findBySql('SELECT * FROM categories')->all();
		$query = Data::find()->where(['category' => $id]);
$pagination = new Pagination([
'defaultPageSize' => 5,
'totalCount' => $query->count(),
]);

$videos = $query->orderBy('id desc')
->offset($pagination->offset)
->limit($pagination->limit)
->all();
$featured = Data::findBySql("SELECT * FROM `data` WHERE `featured`='1' ORDER BY id DESC LIMIT 1")->one();
        return $this->render('category', [
                'categories' => $categories,
				'videos' => $videos,
                'pagination' => $pagination,
				'featured' => $featured,
				'catname' => $catname,				
            ]);
    }
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionVideo()
    {
        $model = new VideoForm();
        if ($model->load(Yii::$app->request->post()) && $model->post()) {
            Yii::$app->session->setFlash('videoFormSubmitted');
			
            return $this->refresh();
        } else {
            return $this->render('video', [
                'model' => $model,
            ]);
        }
    }
	public function actionView($id)
	{
		$video = Data::find()->where(['id' => $id])->one();
		$count = Data::findBySql('SELECT * FROM `data`')->all();
		$c = count($count) - 10;
		$c = rand(0,$c);
		$videos = Data::findBySql("SELECT * FROM `data` WHERE `id`>'".$c."' ORDER BY id LIMIT 10")->all();
		$categories = Categories::findBySql('SELECT * FROM `categories`')->all();
        return $this->render('view', [
                'categories' => $categories,
				'video' => $video,
				'videos' => $videos,
            ]);
	}
	    public function actionDcma()
    {
        return $this->render('dcma');
    }
}
