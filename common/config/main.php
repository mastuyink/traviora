<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Makassar',
    'components' => [
     'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'dateFormat' => 'dd-MM-yyyy',
        'datetimeFormat' => 'd-M-Y H:i:s',
        'decimalSeparator' => ',',
        'thousandSeparator' => '.',
        'currencyCode' => 'Rp ',
        'nullDisplay' => '-',          
    ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],


    ],
    'modules'=>[
    'redactor'             => [
        'class'                => 'yii\redactor\RedactorModule',
        //'uploadDir' => Yii::getAlias('@frontend/web/'),
        //'uploadUrl' => Yii::$app->urlManager->baseUrl,
        //'uploadDir'            => '@webroot/post',
      // 'uploadUrl'            => '@web/post',
        'imageAllowExtensions' =>['jpg','png','jpeg','gif']
        ],

    ],
];
