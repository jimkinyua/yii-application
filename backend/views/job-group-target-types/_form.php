<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\TargetTypes;

/* @var $this yii\web\View */
/* @var $model common\models\JobGroupTargetTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-group-target-types-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'TargetTypeId')->dropDownList(
        ArrayHelper::map(TargetTypes::find()->asArray()->all(), 'TargetTypeId', 'TargetType')
        ,['prompt'=>'Select Target Type']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
