<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\StrategicObjectives;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model common\models\CorporateStrategicObjectives */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="corporate-strategic-objectives-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'StrategicObjectiveId')->dropDownList(
        ArrayHelper::map(StrategicObjectives::find()->asArray()->all(), 'StrategicObjectiveId', 'ObjectiveName')
        ,['prompt'=>'Select Option']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
