<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TargetImprovementAreasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Target Improvement Areas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="target-improvement-areas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Target Improvement Areas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'TargetId',
            'Description',
            'EmpNo',
            'AppraisalPeriodid',
            //'AppraiseeScore',
            //'SupervisorScore',
            //'Addressed',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
