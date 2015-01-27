<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
</head>
<body>

<?php $this->beginBody() ?>
        <?php
            NavBar::begin([
                'brandLabel' => 'ViShare',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-inverse navbar-fixed-top',
                ],
            ]);
			if(Yii::$app->user->isGuest):
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-nav navbar-right','id'=>'navbar'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'Submit video', 'url' => ['/site/video']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                   
                ],
            ]);
			else:
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-nav navbar-right','id'=>'navbar'],
                'items' => [
					['label' => 'Publish new video', 'url' => ['/admin/publish']],
                    ['label' => 'Videos', 'url' => ['/admin/videos']],
                    ['label' => 'Received videos', 'url' => ['/admin/video']],
                    ['label' => 'Categories', 'url' => ['/admin/categories']],					
                ],
            ]);
			endif;
			
            NavBar::end();
        ?>
        <div class="container" id="main">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">Developed by <a href="http://scrisoft.com/" target="_blank">Scrisoft</a></p>
            <p class="pull-right"><?php if(Yii::$app->user->isGuest): echo Html::a('Login', array('admin/login')); else: echo Html::a('Logout (' . Yii::$app->user->identity->username . ')', array('admin/logout'));  endif; ?> | <?php echo Html::a('DCMA', array('site/dcma')); ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
