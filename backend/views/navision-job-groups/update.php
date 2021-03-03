<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NavisionJobGroups */

$this->title = 'Update Navision Job Groups: ' . $model->Scale;
$this->params['breadcrumbs'][] = ['label' => 'Navision Job Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Scale, 'url' => ['view', 'id' => $model->Scale]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="navision-job-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
