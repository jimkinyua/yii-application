<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AreasOfImprovement */

$this->title = 'Update Areas Of Improvement: ' . $model->AreaImprovementId;
$this->params['breadcrumbs'][] = ['label' => 'Areas Of Improvements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AreaImprovementId, 'url' => ['view', 'id' => $model->AreaImprovementId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="areas-of-improvement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
