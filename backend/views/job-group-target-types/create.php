<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobGroupTargetTypes */

$this->title = 'Create Job Group Target Types';
$this->params['breadcrumbs'][] = ['label' => 'Job Group Target Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-group-target-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
