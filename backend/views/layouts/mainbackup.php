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
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
       // ['label' => 'LIST', 'url' => ['/t-post/home']],
        ['label' => 'POSTING', 'url' => ['/t-post/index']],
        ['label' => 'BOOKING', 'url' => ['/t-booking/index']],
        ['label' => 'VALIDASI', 'url' => ['/validasi-pembayaran/index']],
        ['label' => 'DESTINASI', 'url' => ['/t-destinasi/index']],
        ['label' => 'SESI', 'url' => ['/t-sesi-biaya/index']],
        ['label' => 'KHUSUS', 'url' => ['/t-biaya-khusus/index']],
        ['label' => 'LIMIT DEST', 'url' => ['/limit-destinasi/index']],
        /*['label' => 'USER', 'url' => ['/admin/user']],
        ['label' => 'ROUTE', 'url' => ['/admin/route']],
        ['label' => 'ROLES', 'url' => ['/admin/role']],
        ['label' => 'ASSG', 'url' => ['/admin/assignment']],
        ['label' => 'PERM', 'url' => ['/admin/permission']],*/
        
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/admin/user/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/admin/user/logout'], 'post')
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

    <div class="container">
    <?php// require_once('notif.php'); ?>
                         <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
                         
      
    </div>
</div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
