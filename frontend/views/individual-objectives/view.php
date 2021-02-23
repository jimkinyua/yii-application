<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualObjectives */

$this->title = $model->IndividualObjectiveId;
$this->params['breadcrumbs'][] = ['label' => 'Individual Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="individual-objectives-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->IndividualObjectiveId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->IndividualObjectiveId], [
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
            'IndividualObjectiveId',
            'IndividualObjectiveName',
            'IndvidualWorkplanId',
            'DeptObjId',
            'workplan_weight',
        ],
    ]) ?>

</div>
