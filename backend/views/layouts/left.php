<?php 
use mdm\admin\components\Helper;
?><aside class="main-sidebar sidebar-mini ">

    <section class="sidebar">

        <!-- Sidebar user panel 
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/logo.png" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
            </div>
        </div>-->

        <!-- 
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
       -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu fixed'],
                'items' => [
                    ['label' => '', 'options' => ['class' => 'header']],
                    ['label' => 'POSTING', 'icon'=>' fa-bookmark-o', 'url' => Yii::$app->urlManagerFrontend->baseUrl,'visible' => Helper::checkRoute('/destinasi/*')],
                    ['label' => 'BOOKING', 'icon'=>'book', 'url' => ['/booking/index'],'visible' => Helper::checkRoute('/booking/*')],
                    ['label' => 'VALIDASI', 'icon'=>' fa-check-square-o', 'url' => ['/validasi-pembayaran/index'],'visible' => Helper::checkRoute('/booking/*')],
                   //['label' => '', 'url' => ['/post/index']],
                    
                   ['label' => 'TRIP',
                        'icon' => 'plus-square-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Supplier', 'icon' => 'user', 'url' => ['/supplier/index'],],
                            ['label' => 'Kategori', 'icon' => 'tag', 'url' => ['/jenis-destinasi/index'],],
                            ['label' => 'Lokasi', 'icon' => 'globe', 'url' => ['/lokasi-destinasi/index'],],
                            ['label' => 'Name Of Trip', 'icon' => 'map-marker', 'url' => ['/destinasi/index'],],
                           
                            ['label' => 'Tarif Season', 'icon' => 'line-chart', 'url' => ['/sesi-biaya/index'],],
                          
                            
                            
                           
                            ],'visible' => Helper::checkRoute('/content')
                    ],

                    ['label' => 'TRIP',
                        'icon' => 'plus-square-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Supplier', 'icon' => 'user', 'url' => ['/supplier/index'],],
                            ['label' => 'Kategori', 'icon' => 'tag', 'url' => ['/jenis-destinasi/index'],],
                            ['label' => 'Lokasi', 'icon' => 'globe', 'url' => ['/lokasi-destinasi/index'],],
                            ['label' => 'Name Of Trip', 'icon' => 'map-marker', 'url' => ['/destinasi/index'],],
                            //['label' => 'Libur', 'icon' => 'calendar-times-o ', 'url' => ['/libur-trip/index'],],
                            ['label' => 'Limiter', 'icon' => 'dashboard', 'url' => ['/limit-destinasi/index'],],
                            ['label' => 'Tarif Season', 'icon' => 'line-chart', 'url' => ['/sesi-biaya/index'],],
                            ['label' => 'Tarif Khusus', 'icon' => 'money', 'url' => ['/tarif-khusus/index'],],
                            
                            
                           
                            ],'visible'=> Helper::checkRoute('/booking/*')
                    ],

                    ['label' => 'Pickup & Drop off',
                        'icon' => 'car',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Area', 'icon' => 'map', 'url' => ['/lokasi/index'],],
                            ['label' => 'Lokasi', 'icon' => 'map-marker', 'url' => ['/area/index'],],
                            ['label' => 'Time', 'icon' => 'clock-o', 'url' => ['/waktu-jemput/index'],],
                            ['label' => 'Tarif', 'icon' => 'money', 'url' => ['/tarif-aj/index'],],


                           
                            ],'visible'=> Helper::checkRoute('/booking/*')
                    ],

                    ['label' => 'Other',
                        'icon' => 'road',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Extra Data', 'icon' => 'pencil-square', 'url' => ['/extra-data/index'],],
                           

                           
                            ],'visible'=> Helper::checkRoute('/booking/*')
                    ],





                    ['label' => 'DEV TOOL',
                        'icon' => 'trademark',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            /*[
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],*/
                            ],
                    'visible' => Helper::checkRoute('/*')],
                    ['label'=>'User Managaer',
                        'icon'=>'user',
                        'url'=>'#',
                        'items'=>[
                        ['label' => 'USER', 'url' => ['/admin/user']],
                        ['label' => 'ROUTE', 'url' => ['/admin/route']],
                        ['label' => 'ROLES', 'url' => ['/admin/role']],
                        ['label' => 'ASSG', 'url' => ['/admin/assignment']],
                        ['label' => 'PERM', 'url' => ['/admin/permission']],
                    ], 'visible' => Helper::checkRoute('/*')],
                        ['label' => 'Password','icon'=>'lock', 'url' => ['/admin/user/change-password'], 'visible' => !Yii::$app->user->isGuest],
                     ['label' => 'Login','icon'=>'lock', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]
        ) ?>

    </section>

</aside>
