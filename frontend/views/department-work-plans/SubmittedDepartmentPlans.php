<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DepartmentWorkPlansSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Submitted Department Work Plans';
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

            'Code',
            'Description',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{addindividualworkplan}',

                'buttons'  => [

                    'view'   => function ($url, $model) { 
                        $url = Url::to(['/department-work-plans/readonly', 'id' => $model->DepartmentWorkPlanId]);
                        return Html::a('View', $url, ['title' => 'View Department WorkPlan', 'class'=>'btn btn-primary']);
                    },


                    'addindividualworkplan'   => function ($url, $model) { 
                        return  Html::button('Add Individual Work Plan', 
                        ['value' => Url::to(['individual-work-plan/create', 
                        'DepartmentWorkPlanId'=>$model->DepartmentWorkPlanId]),
                          'title' => 'Add Individual Work Plan', 
                            'class' => 'btn btn-success  btn-flat border-warning showModalButton'
                            ]); 
                    },
                

                    
    
                ],

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
