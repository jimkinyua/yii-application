<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AreasOfImprovement */

$this->title = $model->AreaImprovementId;
$this->params['breadcrumbs'][] = ['label' => 'Areas Of Improvements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="areas-of-improvement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->AreaImprovementId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->AreaImprovementId], [
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
            'AreaImprovementId',
            'KeyResultId',
            'Description',
            'EmpNo',
            'AppraisalPeriodid',
            'AppraiseeScore',
            'SupervisorScore',
            'Addressed',
        ],
    ]) ?>

</div>
