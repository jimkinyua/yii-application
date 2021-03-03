<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Evaluations */

$this->title = $model->EvaluationId;
$this->params['breadcrumbs'][] = ['label' => 'Evaluations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="evaluations-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->EvaluationId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->EvaluationId], [
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
            'EvaluationId',
            'WorkPlanId',
            'AppraisalPeriodid',
            'Status',
            'Contested',
            'EvaluationTypeId',
            'EmpNo',
            'Code',
            'ImmediateSupervisor',
        ],
    ]) ?>

</div>
