<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EvaluationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evaluations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Code',
            [
                'label'=>'Individual Work Plan No',
                'value'=>'workPlan.Code'
            ],
            [
                'label'=>'Individual Work Plan No',
                'value'=>'appraisalPeriod.Description'
            ],
            
            // 'Status',
            // 'Contested',
            //'EvaluationTypeId',
            //'EmpNo',
            //'Code',

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}',
                'buttons'  => [
                    'view'   => function ($url, $model) { 
                        $url = Url::to(['/evaluations/evaluate', 'EvaluationId' => $model->EvaluationId]);
                        return Html::a('Evaluate', $url, ['title' => 'View Work Plan', 'class'=>'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
