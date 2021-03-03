<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\TargetTypes;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model common\models\Targets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="targets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TargetDescription')->textInput() ?>

    <?= $form->field($model, 'TargetTypeId')->dropDownList(
        ArrayHelper::map(TargetTypes::find()->asArray()->all(), 'TargetTypeId', 'TargetType')
        ,['prompt'=>'Select Target Type']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
