<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
$sesi = Yii::$app->session;
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">TRV</span><span class="logo-lg">TRAVIORA</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

            
                
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="/validasi-pembayaran" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"> </i>
                        <span class="label label-danger"><?= $sesi['validasi.jumlah']?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><?= $sesi['validasi.jumlah']?> Booking Perlu Validasi</li>
                        
                        <li class="footer">
                            <a class='btn-danger btn-block' href="/validasi-pembayaran">Lihat Semua</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/logo.png" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?= Yii::$app->user->identity->username ?>
                                <small>TRAVIORA</small>
                            </p>
                        </li>
                        <!-- Menu Body 
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <! Menu Footer-->
                        <li class="user-footer">
                            
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-danger btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
