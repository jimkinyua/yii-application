<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\KeyResultAreasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Key Result Areas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-result-areas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Key Result Areas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'KeyResultAreaId',
            'TaskId',
            'EvaluationId',
            'AppraiseeRemarks',
            'SelfRating',
            //'SupervisorRating',
            //'SupervisorRemarks',
            //'Evidence_File',
            //'Ontime:datetime',
            //'FaultReason',
            //'AgreedScore',
            //'Achievements',
            //'IndividualObjectiveId',
            //'TaskDescription',
            //'WorkPlanWeight',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
