<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\EvaluateTasksImprovementAreasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evaluate Tasks Improvement Areas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluate-tasks-improvement-areas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Evaluate Tasks Improvement Areas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'EvaluationId',
            'Description',
            'SelfRating',
            'SupervisorRating',
            //'AgreedScore',
            //'SupervisorRemarks',
            //'Achievements',
            //'Addressed',
            //'TargetImprovementAreaId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
