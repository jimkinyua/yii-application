<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluateTargetImprovementAreas */

$this->title = 'Create Evaluate Target Improvement Areas';
$this->params['breadcrumbs'][] = ['label' => 'Evaluate Target Improvement Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluate-target-improvement-areas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
