<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
if(Yii::$app->user->isGuest):
exit();
endif;
$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1 style="margin-bottom:50px"><?= Html::encode($this->title) ?></h1>
<?php
foreach($videos as $video):
?>
    <div class="alert alert-info">
        <?php echo Html::a('Delete',['admin/dvideo', 'id' => $video->id],array('class'=>'btn btn-xs btn-primary pull-right')); ?>
        <strong><?php echo $video->title; ?></strong>
    </div>
<?php
endforeach;
?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
