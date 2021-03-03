<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AppraisalPeriods */

$this->title = 'Update Appraisal Periods: ' . $model->AppraisalPeriodId;
$this->params['breadcrumbs'][] = ['label' => 'Appraisal Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AppraisalPeriodId, 'url' => ['view', 'id' => $model->AppraisalPeriodId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appraisal-periods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
