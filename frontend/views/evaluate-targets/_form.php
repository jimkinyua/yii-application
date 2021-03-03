<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PscRating;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluateTargets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluate-targets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TargetDescription')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'SelfRating')->dropDownList(
        ArrayHelper::map(PscRating::find()->all(),
        'Rating','Description'),
        ['prompt'=>'Choose Rating'])
     ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
