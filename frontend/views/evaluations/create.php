<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Evaluations */

$this->title = 'Create Evaluations';
$this->params['breadcrumbs'][] = ['label' => 'Evaluations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'EvalTypes'=>$EvalTypes,
        'DropDownAppraisalPeriods'=>$DropDownAppraisalPeriods


    ]) ?>

</div>
