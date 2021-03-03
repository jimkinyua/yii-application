<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobGroupTargetTypes */

$this->title = 'Update Job Group Target Types: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Job Group Target Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="job-group-target-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
