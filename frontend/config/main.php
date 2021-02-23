<?php
use kartik\mpdf\Pdf;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
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
            ],
        ],

        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'options'=> ['shrink_tables_to_fit' => 0],
            'destination' => Pdf::DEST_BROWSER,
            'filename' => 'workplan.pdf',//needs a component returning a user name
            'methods' => [
                'SetHeader' => ['IITA || Staff Performance Appraisal'],
                'SetFooter' => ['|Page {PAGENO}|'],
            ],
            'cssInline' => 'h1,h2,table{font-family: font-family: Cambria, Georgia, serif;},
            .borderless td, .borderless th,thead tr,tbody tr{border: 1px solid #fff;font-size:12px},
            thead th{background-color: #f39c12;color: #fff;text-align:center;vertical-align:middle;},
            tbody td{background-color: #eeeeee;}, 
            .details{border:2px solid #000;},
            h1{}',
        ],
    
    ],
    'params' => $params,
];
