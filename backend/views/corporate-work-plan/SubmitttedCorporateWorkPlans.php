<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
// echo '<pre>';
// print_r($searchModel);
// exit;


/* @var $this yii\web\View */
/* @var $searchModel common\models\CorporateWorkPlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Submited Corporate Work Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corporate-work-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CorporateWorkPlanId',
            // 'StrategicPlanId',
            // 'Status',
            'Code',
            'Description',
            

            [   'class' => 'yii\grid\ActionColumn',
                'template' => '{edit}{adddepartmentwrokplan}',
                'buttons'  => [
                    'edit'   => function ($url, $model) { 
                        $url = Url::to(['/corporate-work-plan/readonly', 'id' => $model->CorporateWorkPlanId]);
                        return Html::a('View Corporate WorkPlan', $url, ['title' => 'View Work Plan', 'class'=>'btn btn-primary']);
                    },
                    
                    'adddepartmentwrokplan'   => function ($url, $model) { 
                      return  Html::button('Add Department Work Plan', ['value' => Url::to(['department-work-plans/create', 'CorporateWorkPlanId'=>$model->CorporateWorkPlanId]),
                        'title' => 'Add Department Work Plan', 'class' => 'btn btn-success  btn-flat border-warning showModalButton']); 

                        // $url = Url::to(['/department-work-plans/create', 'CorporateWorkPlanId' => $model->CorporateWorkPlanId]);
                        // return Html::a('Add Department Work Plan', $url, ['title' => 'Add Department WorkPlan', 'class'=>'btn btn-warning']);
                    },
    
                ],

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
