<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\VideoForm;
use app\models\PublishForm;
use app\models\CategoriesForm;
use app\models\Data;
use app\models\Video;
use app\models\Categories;
use yii\db\ActiveRecord;
class AdminController extends Controller
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
                    'logout' => ['get'],
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
	
    public function actionLogin()
    {
		Yii::$app->user->logout();
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
	
    public function actionPublish()
    {
        $model = new PublishForm();
        if ($model->load(Yii::$app->request->post()) && $model->post()) {
            Yii::$app->session->setFlash('publishFormSubmitted');
			
            return $this->refresh();
        } else {
			$categories = Categories::findBySql('SELECT * FROM categories')->all();
            return $this->render('publish-video', [
                'model' => $model,
				'categories' => $categories,
            ]);
        }
    }
		public function actionDvideo($id)
	{
		$dcat = Data::find()->where(['id' => $id])->one();
		$dcat->delete();
        $this->redirect("videos");	
	}
    public function actionVideos()
    {
$query = Data::find();
$pagination = new Pagination([
'defaultPageSize' => 5,
'totalCount' => $query->count(),
]);

$videos = $query->orderBy('id desc')
->offset($pagination->offset)
->limit($pagination->limit)
->all();

return $this->render('videos', [
'videos' => $videos,
'pagination' => $pagination,
]);
    }
		public function actionDvideor($id)
	{
		$dcat = Video::find()->where(['id' => $id])->one();
		$dcat->delete();
        $this->redirect("video");	
	}
    public function actionVideo()
    {
$query = Video::find();
$pagination = new Pagination([
'defaultPageSize' => 5,
'totalCount' => $query->count(),
]);

$videos = $query->orderBy('id desc')
->offset($pagination->offset)
->limit($pagination->limit)
->all();

return $this->render('rvideos', [
'videos' => $videos,
'pagination' => $pagination,
]);
    }	
	public function actionDcat($id)
	{
		$dcat = Categories::find()->where(['id' => $id])->one();
		$dcat->delete();
        $this->redirect("categories");	
	}
	public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	    public function actionCategories()
    {
        $model = new CategoriesForm();
        if ($model->load(Yii::$app->request->post()) && $model->post()) {
            return $this->refresh();
        } else {
			$categories = Categories::findBySql('SELECT * FROM categories ORDER BY id DESC')->all();
            return $this->render('categories', [
                'model' => $model,
				'categories' => $categories,
            ]);
        }
    }
}
