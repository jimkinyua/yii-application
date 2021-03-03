<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\EvaluationTypes;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Evaluations */
/* @var $form yii\widgets\ActiveForm */

//Get Evaluation Types Linked with the Strategic Objective



?>

<div class="evaluations-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'AppraisalPeriodid')->dropDownList(
        ArrayHelper::map($DropDownAppraisalPeriods,
        'AppraisalPeriodId', 'Description')
        ,['prompt'=>'Select Aappraisal Period',
        'id'=>'AppraisalPeriodid'],
        ['id'=>'AppraisalPeriodid']
        );
    ?>

    <?=
        // Child # 1
        $form->field($model, 'EvaluationTypeId')->widget(DepDrop::classname(), [
            'options'=>['id'=>'EvaluationTypeId'],
            'pluginOptions'=>[
                'depends'=>['AppraisalPeriodid'],
                'placeholder'=>'Select Evaluation Period',
                'url'=>Url::to(['/evaluations/evaluation-periods'])
            ]
        ]);

    ?>

    


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
