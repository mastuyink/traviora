<?php
$params = array_merge(
  //  require(__DIR__ . '/../../common/config/params.php'),
    //require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
     'homeUrl' => '/',
    'id' => 'app-frontend',
   // 'homeUrl'=>['/posting/home'],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules'             => [
        'admin' => [
                'class' => 'mdm\admin\Module',
                /*'controllerMap' => [
            'assignment' => [
                'class' => 'mdm\admin\controllers\AssignmentController',
                'userClassName' => 'app\models\User',
                'idField' => 'id'
            ],

            ],*/
            ],
    ],
    'components' => [

    'mailClient' => [
        'class' => 'yii\swiftmailer\Mailer',
      //  'viewPath' => '@common/mail',
        'useFileTransport' => false,
        'transport' => [
        'class' => 'Swift_SmtpTransport',
           'host' => 'mail.istanatravel.com',
           'username' =>'web@istanatravel.com',
           'password' =>'juhing1994',
           'port' => '465',
           'encryption' => 'ssl',
     ],
    ],


    'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'enableAutoLogin' => true,
            'identityCookie'  => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl' => ['sign-in'],
        ],
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],*/
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
      

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                 
                 '/booking/term-service/<name>' => '/booking/term-service',
                 '<lokasi>/<kategori>/<slug>'     => '/posting/view',
                 '/posting/view/<slug>'         => '/posting/view',
                 '/timeout'                     => '/site/timeout',
                 '/sign-in'                     => '/site/login',
                 '/sign-out'                    => '/site/logout',
                 '/contact'                     =>'/site/contact',
                 '/destinasi/adventure'         =>'/posting/adventure',
                 '/destinasi/nature'            =>'/posting/nature',
                 '/destinasi/budaya'            =>'/posting/budaya',
            ],
          
        ],

    ],

        /*'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
        '/*',
        'site/*',
        'posting/*',
        'posting/view',
       // 'posting/dest',
        'posting/cari-harga',
        'booking/tahap-1',
        'booking/tahap-2',
        'booking/tahap-3',
        'booking/check-out',
        'booking/end-order',
        'booking/confirm-payment',
        'booking/area',
        'booking/pickup-time',
        'booking/extra-pickup',
        'booking/dual-mode',
        'booking/extra-drop',
        'booking/dual-model',


       // 'posting/cek-limit',
      //  'posting/cari-dest',
           //'site/*',
           //'admin/*',
            //'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],*/
    'params' => $params,
];
