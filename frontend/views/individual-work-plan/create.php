<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualWorkPlan */

$this->title = 'Create Individual Work Plan';
$this->params['breadcrumbs'][] = ['label' => 'Individual Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individual-work-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
