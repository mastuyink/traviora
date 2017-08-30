<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [

   // 'homeUrl'             => '/office',
    'id'                  => 'app-backend',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap'           => ['log'],
    
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
               'gridview' =>  [
               'class' => '\kartik\grid\Module'
               // enter optional module parameters below - only if you need to  
               // use your own export download action or custom translation 
               // message source
               // 'downloadAction' => 'gridview/export/download',
                //'i18n' => []
               ],

        'redactor'             => [
        'class'                => 'yii\redactor\RedactorModule',
        //'uploadDir' => Yii::getAlias('@frontend/web/'),
        //'uploadUrl' => Yii::$app->urlManager->baseUrl,
        //'uploadDir'            => '@webroot/post',
      // 'uploadUrl'            => '@web/post',
        'imageAllowExtensions' =>['jpg','png','jpeg','gif']
        ],
],
    'components' => [
    'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'dateFormat' => 'dd-MM-yyyy',
        'datetimeFormat' => 'dd-M-Y HH:i',
        'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'nullDisplay' => '',
        //'decimalSeparator' => ',',
       // 'thousandSeparator' => '.',
        //'currencyCode' => 'Rp ',
       // 'nullDisplay' => '-',          
    ],
    
        'request' => [
            'csrfParam' => '_csrf-backend',
           // 'baseUrl' => '/office',
        ],
        /*'user' => [
        'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie'  => ['name' => '_identity-backend', 'httpOnly' => true],
            ],*/
             'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'enableAutoLogin' => true,
            'identityCookie'  => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['admin/user/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            ],
        ],

        

       /* 'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
             ],
         ],
    ],*/
        
        
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
           //'site/*',
           //'admin/*',
            //'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'params' => $params,
];
