<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TargetImprovementAreas */

$this->title = 'Create Target Improvement Areas';
$this->params['breadcrumbs'][] = ['label' => 'Target Improvement Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="target-improvement-areas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
