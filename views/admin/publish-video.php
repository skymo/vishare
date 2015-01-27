<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
if(Yii::$app->user->isGuest):
exit();
endif;
$this->title = 'Publish your video';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('publishFormSubmitted')): ?>

    <div class="alert alert-success">
       Your videos was published successfully!
    </div>

    <?php else: ?>

    <div class="row">
        <div class="col-lg-5">
<?php
$id = '';
$name = '';
if($categories):
foreach($categories as $category):
$id[] = $category->id;
$name[] = $category->name;
endforeach;
$result = array_combine($id, $name);
else:
$result = array("0"=>"No categories found");
endif;
 $form = ActiveForm::begin(['id' => 'video-form']); ?>
                <?= $form->field($model, 'title')->textInput(array('placeholder' => 'Enter the title here...')) ?>
                <?= $form->field($model, 'category')->dropDownList($result) ?>
                <?= $form->field($model, 'preview')->textInput(array('placeholder' => 'http://'))->label('Preview image') ?>
                <?= $form->field($model, 'description')->textArea(array('placeholder' => 'enter a description for your video...','rows' => 6))->label('Description') ; ?>
                <?= $form->field($model, 'embed')->textArea(array('placeholder' => 'enter embed code here...','rows' => 6))->label('Embed code') ; ?>
                <?= $form->field($model, 'featured')->checkbox()->label('Show this video on the first page') ; ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'video-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
