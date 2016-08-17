<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'defaultRoute' => 'book/index',
    'modules' => [],
    'components' => [
        //We'll be using the Bootstrap Simplex theme
        //So, remove the default one
        'assetManager' => [
                'bundles' => [
                    'yii\bootstrap\BootstrapAsset' => false
                ]
            ],    

//    	'formatter' => ['locale' => 'ta-IN'],
        // 'language' =>'ta-IN',
        'urlManager' =>[
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => ['<controller>/<id:\d+>' => '<controller>/edit']
        ],
        'authManager' => ['class' => 'yii\rbac\PhpManager'],
        'user' => [
            'identityClass' => 'backend\models\AdminUser',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_backenduser'],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'profile'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
    'modules' => [
        'gii' => [
          'class' => 'yii\gii\Module', //adding gii module
          'allowedIPs' => ['127.0.0.1', '::1']  //allowing ip's 
        ],
	]
    
];
