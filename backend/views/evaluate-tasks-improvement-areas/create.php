<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluateTasksImprovementAreas */

$this->title = 'Create Evaluate Tasks Improvement Areas';
$this->params['breadcrumbs'][] = ['label' => 'Evaluate Tasks Improvement Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluate-tasks-improvement-areas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
