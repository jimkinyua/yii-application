<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CorporateStrategicObjectives */

$this->title = $model->CorporateObjectiveId;
$this->params['breadcrumbs'][] = ['label' => 'Corporate Strategic Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="corporate-strategic-objectives-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CorporateObjectiveId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CorporateObjectiveId], [
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
            'CorporateObjectiveId',
            'CorporateWorkPlanId',
            'StrategicObjectiveId',
        ],
    ]) ?>

</div>
