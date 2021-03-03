<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\NavisionJobGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="navision-job-groups-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'timestamp',
            'Scale',
            // 'Minimum Pointer',
            // 'Maximum Pointer',
            // 'House Allowance',
            //'Commuter Allowance',
            //'In Patient Limit',
            //'Out Patient Limit',
            //'Grade Identifier',
            //'Annual Increaments',
            //'Extreneous Allowance',
            //'Leave Allowance',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
                'buttons'  => [
                    'view'   => function ($url, $model) { 
                        $url = Url::to(['/navision-job-groups/view', 'id' => $model->Scale]);
                        return Html::a('View Job Group', $url, ['title' => 'View Work Plan', 'class'=>'btn btn-primary']);
                    }, 
    
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
