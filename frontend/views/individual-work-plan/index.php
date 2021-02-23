<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\IndividualWorkPlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Open Individual Work Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individual-work-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!-- <?= Html::a('Create Individual Work Plan', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'IndividualWorkPlanId',
            'Code',
            'Description',
            'EmpNo',
            // 'DeptWorkPlanId',
            [
                'label'=>'Department Work Plan',
                'value'=>'deptWorkPlan.Code'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
