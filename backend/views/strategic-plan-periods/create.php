<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StrategicPlanPeriods */

$this->title = 'Create Strategic Plan Periods';
$this->params['breadcrumbs'][] = ['label' => 'Strategic Plan Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="strategic-plan-periods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
