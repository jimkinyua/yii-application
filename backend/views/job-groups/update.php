<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobGroups */

$this->title = 'Update Job Groups: ' . $model->JobId;
$this->params['breadcrumbs'][] = ['label' => 'Job Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->JobId, 'url' => ['view', 'id' => $model->JobId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="job-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
