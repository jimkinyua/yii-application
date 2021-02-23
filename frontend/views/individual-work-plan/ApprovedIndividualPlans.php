<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\IndividualWorkPlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Approved Individual Work Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individual-work-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'IndividualWorkPlanId',
            'Code',
            'Description',
            'EmpNo',
            // 'DeptWorkPlanId',
            [
                'label'=>'Department Work Plan',
                'value'=>'deptWorkPlan.Code'
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons'  => [
                    'view'   => function ($url, $model) { 
                        $url = Url::to(['/individual-work-plan/readonly', 'id' => $model->IndividualWorkPlanId]);
                        return Html::a('View Individual WorkPlan', $url, ['title' => 'View Work Plan', 'class'=>'btn btn-primary']);
                    },
                ],

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
