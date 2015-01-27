<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
if(Yii::$app->user->isGuest):
exit();
endif;
$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1 style="margin-bottom:50px"><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'video-form']); ?>
                <?= $form->field($model, 'name')->textInput(array('placeholder' => 'Enter new category here...'))->label('Name of category') ?>
                <div class="form-group">
                    <?= Html::submitButton('Add category', ['class' => 'btn btn-primary', 'name' => 'video-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    
       <div class="row">
        <div class="col-lg-5">
<h3 style="margin-top:50px">Categories</h3>
<ul>
<?php foreach ($categories as $category): ?>
<li>
<?= $category->name ?><?php echo Html::a('<img src="'.Yii::$app->request->baseUrl.'/img/delete.png" hspace="5" width="16" height="16" />',['admin/dcat', 'id' => $category->id]); ?>
</li>
<?php endforeach; ?>
</ul>
        </div>
    </div>
</div>
