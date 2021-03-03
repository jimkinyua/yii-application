<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TargetTypes */

$this->title = 'Update Target Types: ' . $model->TargetTypeId;
$this->params['breadcrumbs'][] = ['label' => 'Target Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TargetTypeId, 'url' => ['view', 'id' => $model->TargetTypeId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="target-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
