<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AppraisalPeriods */

$this->title = 'Create Appraisal Periods';
$this->params['breadcrumbs'][] = ['label' => 'Appraisal Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appraisal-periods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
