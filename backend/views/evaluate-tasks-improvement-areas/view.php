<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluateTasksImprovementAreas */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Evaluate Tasks Improvement Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="evaluate-tasks-improvement-areas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'EvaluationId',
            'Description',
            'SelfRating',
            'SupervisorRating',
            'AgreedScore',
            'SupervisorRemarks',
            'Achievements',
            'Addressed',
            'TargetImprovementAreaId',
        ],
    ]) ?>

</div>
