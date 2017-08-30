<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<style type="text/css">
/* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

.carousel {
  margin-bottom: 60px;
}

.carousel-control {
  top: 76%;
}

.carousel-caption {
  z-index: 10;
}

.carousel .item {
  height: 500px;
  background-color:#bbb;
  overflow:hidden;
}
.carousel img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 500px;
}


/* RESPONSIVE CSS
-------------------------------------------------- */
@media (max-width: 768px) {

  .carousel-inner>.item>img, .carousel-inner>.item>a>img {
    max-width:inherit;
  }

  .carousel-caption p {
    margin-bottom: 20px;
    font-size: 21px;
    line-height: 1.4;
  }
}


</style>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'TRAVIORA',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
       // ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'HOME', 'url' => ['/']],
        ['label' => 'Adventure', 'url' => ['/destinasi/adventure']],
        ['label' => 'Nature', 'url' => ['/destinasi/nature']],
        ['label' => 'Contact Us', 'url' => ['/site/contact']],
        
        //['label' => 'BOOKING', 'url' => ['/booking/index']],
      //  ['label' => 'VALIDASI', 'url' => ['/validasi-pembayaran/index']],
       // ['label' => 'DESTINASI', 'url' => ['/t-destinasi/index']],
        
    ];
    if (!Yii::$app->user->isGuest){
         $menuItems[] =['label' => 'Carrousel', 'url' => ['/main-carrousel/index']];
         $menuItems[]=['label' => 'Posting', 'url' => ['/posting/index']];
        $menuItems[] =  '<li>'
            . Html::beginForm(['/sign-out'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';

    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
  <center style="margin-top: 49px;" class="block">
<div style="padding-left: 1px; margin-left: 1px; min-height: 50%; max-height: 50%; max-width:100%;  min-width: 100%;" id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
     <?php foreach (array_slice(Yii::$app->view->params['carrousel'],1) as $key => $value):?>
    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key ?>"></li>
     <?php endforeach; ?>
  </ol>
<div class="item active">
      <img src="/site/main-carrousel?id=<?php echo Yii::$app->view->params['carrousel'][0]->id?>" alt="...">
      <div class="carousel-caption">
       
      </div>
    </div>
  <?php foreach (array_slice(Yii::$app->view->params['carrousel'],1) as $key => $value):?>
    <div class="item">
      <img src="/site/main-carrousel?id=<?php echo $value->id ?>" alt="...">
      <div class="carousel-caption">
       
      </div>
    </div>
    <?php endforeach; ?>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
</center>


                        <div class="col-md-12">
                         <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
                         
           
</div>
</div>

<div class="col-md-12 container">
<footer style="background-color: transparent; padding-top: 50px;" >
    <div  style="background-color: black;">
        <p class="pull-left"><strong>&copy; TRAVIORA <?= date('Y') ?></strong></p>

    </div>
</footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
