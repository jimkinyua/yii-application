<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluateTargets */

$this->title = 'Create Evaluate Targets';
$this->params['breadcrumbs'][] = ['label' => 'Evaluate Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluate-targets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
