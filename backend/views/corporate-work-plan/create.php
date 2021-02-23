<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CorporateWorkPlan */

$this->title = 'Create Corporate Work Plan';
$this->params['breadcrumbs'][] = ['label' => 'Corporate Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corporate-work-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
