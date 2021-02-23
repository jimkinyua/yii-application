<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualObjectivesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="individual-objectives-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'IndividualObjectiveId') ?>

    <?= $form->field($model, 'IndividualObjectiveName') ?>

    <?= $form->field($model, 'IndvidualWorkplanId') ?>

    <?= $form->field($model, 'DeptObjId') ?>

    <?= $form->field($model, 'workplan_weight') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
