<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\IndividualWorkPlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rejected Individual Work Plans';
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
            // [
            //     'label'=>'Department Work Plan',
            //     'value'=>'deptWorkPlan.Code'
            // ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{rejectioncomments}',
                'buttons'  => [
                    'view'   => function ($url, $model) { 
                        $url = Url::to(['/individual-work-plan/view', 'id' => $model->IndividualWorkPlanId]);
                        return Html::a('View WorkPlan', $url, ['title' => 'View Work Plan', 'class'=>'btn btn-primary']);
                    },
                    'rejectioncomments'   => function ($url, $model) { 
                        $url = Url::to(['/individual-work-plan/readonly', 'id' => $model->IndividualWorkPlanId]);
                        return Html::button('Supervisor Comments',
                        [  'value' => Url::to(['individual-work-plan/comments',
                           'IndividualWorkPlanId'=>$model->IndividualWorkPlanId,]),
                           'title' => 'View Supervisor Comments',
                           'class' => 'btn btn-success  btn-flat border-warning showModalButton']);
                    },
                ],

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
