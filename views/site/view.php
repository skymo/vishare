<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$this->title = $video->title;
?>
<div class="site-login">
      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <div class="jumbotron">
<?php 
$embed = $video->embed;
$rem = explode('width="',$embed);
$rem2 = explode('"',@$rem[1]);
$rem3 = str_replace(@$rem2[0],'',@$rem[1]);
$rem4 = @$rem[0].'width="100%"'.@$rem[1];
$rem5 = explode('height="',$rem4);
$rem6 = explode('"',@$rem5[1]);
$rem7 = str_replace(@$rem6[0],'',@$rem5[1]);
echo @$rem5[0].'height="100%"'.@$rem5[1];
?>
<br />
<br />
          </div>
<div class="jumbotronn">
<h3><strong><?php echo $this->title; ?></strong></h3>
<p><?php echo $video->description; ?></p>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "http://connect.facebook.net/en_US/sdk.js#xfbml=1&appId=332726383597480&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="<?php echo $link; ?>" data-numposts="5" data-colorscheme="light"></div>
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
        </div>
        <div class="col-xs-6 col-sm-3" id="sidebar">
<div class="list-group">
<?php 
$i = 0;
if($categories):
echo Html::a('All Categories',['site/index'],array('class'=>'list-group-item active'));
foreach ($categories as $category): 
echo Html::a($category->name,['site/category', 'id' => $category->id],array('class'=>'list-group-item')); 
$i++;
endforeach;
endif;
?>
</div>
</div>
</div></div>