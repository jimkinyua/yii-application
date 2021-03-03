<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\EvaluateTargetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evaluate Targets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluate-targets-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Evaluate Targets', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'WorkPlanId',
            'SelfRating',
            'SupervisorRating',
            'AgreedScore',
            //'SupervisorRemarks',
            //'TargetTypeId',
            //'Achievements',
            //'TargetId',
            //'EvaluationId',
            //'TargetDescription',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
