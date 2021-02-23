<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \common\models\StrategicPlanPeriods

/* @var $this yii\web\View */
/* @var $model common\models\StrategicObjectives */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="strategic-objectives-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ObjectiveName')->textInput() ?>

    <?= $form->field($model, 'StrategicPlanId')->dropDownList(
        ArrayHelper::map(StrategicPlanPeriods::find()->asArray()->all(), 'PlanId', 'Name')
        ,['prompt'=>'Select Period']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
