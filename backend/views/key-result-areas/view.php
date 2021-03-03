<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\KeyResultAreas */

$this->title = $model->KeyResultAreaId;
$this->params['breadcrumbs'][] = ['label' => 'Key Result Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="key-result-areas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->KeyResultAreaId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->KeyResultAreaId], [
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
            'KeyResultAreaId',
            'TaskId',
            'EvaluationId',
            'AppraiseeRemarks',
            'SelfRating',
            'SupervisorRating',
            'SupervisorRemarks',
            'Evidence_File',
            'Ontime:datetime',
            'FaultReason',
            'AgreedScore',
            'Achievements',
            'IndividualObjectiveId',
            'TaskDescription',
            'WorkPlanWeight',
        ],
    ]) ?>

</div>
