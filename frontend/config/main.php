<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'library/index',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [],
    'components' => [
        //We'll be using the Bootstrap Simplex theme
        //So, remove the default one
        'assetManager' => [
                'bundles' => [
                    'yii\bootstrap\BootstrapAsset' => false
                ]
            ],    
        'urlManager' =>[
            'enablePrettyUrl' => true,
            'showScriptName' => false
        ],
    
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_frontenduser']
        ],
        'session' => [
            'name' => 'PHPFRONTSESSID',
            'savePath' => sys_get_temp_dir()
        ],
        'request' => [
            'cookieValidationKey' => '123-456-ABC',
            'csrfParam' => '_frontendCSRF'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
    ],
    'params' => $params,
    // 'modules' => [
    //     'gii' => [
    //       'class' => 'yii\gii\Module', //adding gii module
    //       'allowedIPs' => ['127.0.0.1', '::1']  //allowing ip's 
    //     ],
  // ]    
];
