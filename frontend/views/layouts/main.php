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
$this->title = $this->title ? $this->title : 'Welcome To Traviora';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
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
        ['label' => 'HOME', 'url' => ['/']],
        ['label' => 'Adventure', 'url' => ['/destinasi/adventure']],
        ['label' => 'Nature', 'url' => ['/destinasi/nature']],
        ['label' => 'Contact Us', 'url' => ['/contact']],
        
       
    ];
    if (Yii::$app->user->isGuest) {
       // $menuItems[] = ['label' => 'Login', 'url' => ['/sign-in']];
    } else {
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

                       <!-- <div style="padding-top: 5%;" class="col-md-12"> -->
                          <div class="container"> <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?></div>
                         
        <?= Alert::widget() ?>
        <?= $content ?>
                         
      
   <!-- </div> -->
</div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; TRAVIORA <?= date('Y') ?></p>


    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
