<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\IndividualObjectivesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Individual Objectives';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individual-objectives-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Individual Objectives', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'IndividualObjectiveId',
            'IndividualObjectiveName',
            'IndvidualWorkplanId',
            'DeptObjId',
            'workplan_weight',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
