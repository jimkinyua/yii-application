<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

// echo '<pre>';
// print_r($Rss);
// exit;


/* @var $this yii\web\View */
/* @var $model common\models\DepartmentObjectives */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-objectives-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'StrategicObjectiveId')->dropDownList(
        ArrayHelper::map($CorporateObjectives, 'StrategicObjectiveId', 'ObjectiveName')
        ,['prompt'=>'Select Strategic Objective']
    ) ?>

    <?= $form->field($model, 'ObjectiveName')->textInput() ?>

  


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
