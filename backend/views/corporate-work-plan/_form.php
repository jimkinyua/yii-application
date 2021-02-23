<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \common\models\StrategicPlanPeriods


/* @var $this yii\web\View */
/* @var $model common\models\CorporateWorkPlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="corporate-work-plan-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'StrategicPlanId')->dropDownList(
        ArrayHelper::map(StrategicPlanPeriods::find()->asArray()->all(), 'PlanId', 'Name')
        ,['prompt'=>'Select Period']
    ) ?>

    <!-- <?= $form->field($model, 'Status')->textInput() ?> -->

    <!-- <?= $form->field($model, 'Code')->textInput() ?> -->

    <?= $form->field($model, 'Description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
