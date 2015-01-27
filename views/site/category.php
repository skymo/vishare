<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
if(!isset($_GET["page"])):
$page = 1;
else:
$page = $_GET["page"];
endif;
$this->title = 'Category Archives: '.$catname->name.' | Page '.$page;
?>
<div class="site-login">
      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <div class="jumbotron">
<?php
$rem = explode('width="',$featured->embed);
$rem2 = explode('"',@$rem[1]);
$rem3 = str_replace(@$rem2[0],'',@$rem[1]);
$rem4 = @$rem[0].'width="100%"'.@$rem[1];
$rem5 = explode('height="',$rem4);
$rem6 = explode('"',@$rem5[1]);
$rem7 = str_replace(@$rem6[0],'',@$rem5[1]);
echo @$rem5[0].'height="100%"'.@$rem5[1];
?>
          </div>
<?php
foreach($videos as $video):
?>
          <div class="jumbotronn">
              <img src="<?php echo $video->preview; ?>" width="160" height="90" align="left" />
<h3><?php echo Html::a($video->title,['site/view', 'id' => $video->id]); ?></h3>
<p><?php echo substr(strip_tags($video->description),0,370); ?>...</p>
          </div>
<?php
endforeach;
?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
        </div>
        <div class="col-xs-6 col-sm-3" id="sidebar">
<div class="list-group">
<?php 
$i = 0;
if($categories):
echo Html::a('All Categories',['site/index'],array('class'=>'list-group-item'));
foreach ($categories as $category):
if($category->id == $catname->id):
echo Html::a($category->name,['site/category', 'id' => $category->id],array('class'=>'list-group-item active'));
else:
echo Html::a($category->name,['site/category', 'id' => $category->id],array('class'=>'list-group-item')); 
endif;
$i++;
endforeach;
endif;
?>
</div>
</div>
</div></div>