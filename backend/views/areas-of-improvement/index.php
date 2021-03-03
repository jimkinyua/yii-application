<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AreasOfImprovementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Areas Of Improvements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areas-of-improvement-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Areas Of Improvement', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AreaImprovementId',
            'KeyResultId',
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
