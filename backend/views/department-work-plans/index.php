<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DepartmentWorkPlansSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Open Department Work Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-work-plans-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Create Department Work Plans', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'DepartmentWorkPlanId',
            // 'CorporateWorkPlanId',
            'Code',
            'Description',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{edit}{delete}',

                'buttons'  => [
                    'edit'   => function ($url, $model) { 
                        $url = Url::to(['/department-work-plans/view', 'id' => $model->DepartmentWorkPlanId]);
                        return Html::a('View', $url, ['title' => 'Add Department WorkPlan', 'class'=>'btn btn-primary']);
                    },
    
                    'delete'   => function ($url, $model) {
                        $url = Url::to(['/department-work-plans/delete', 'DepartmentWorkPlanId' => $model->DepartmentWorkPlanId]);
                        return Html::a('Delete', $url, ['title' => 'View Corporate WorkPlan','class'=>'btn btn-danger']);
                    },
                ],

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
