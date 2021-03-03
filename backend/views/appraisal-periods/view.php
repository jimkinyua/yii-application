<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\StrategicPlanPeriods;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\AppraisalPeriods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appraisal-periods-form">

    <?php $form = ActiveForm::begin([
        'id'=>'appraisal-periods-form'
            ]); ?>

            <?= $form->field($model, 'Description')->textInput() ?>

            <?= $form->field($model, 'StartDate')->widget(\yii\jui\DatePicker::className(), [
            'options' => ['class' => 'form-control'],
            // ... you can configure more DatePicker properties here
            ]) ?>

            <?= $form->field($model, 'EndDate')->widget(\yii\jui\DatePicker::className(), [
            'options' => ['class' => 'form-control'],
            // ... you can configure more DatePicker properties here
            ]) ?>



            <?= $form->field($model, 'StarategicPlanPeriod')->dropDownList(
                ArrayHelper::map(StrategicPlanPeriods::find()->asArray()->all(), 'PlanId', 'Name')
                ,['prompt'=>'Select Period']
            ) ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        
    <?php ActiveForm::end(); ?>

    <div class="col-lg-12">
        <div class="card card-outline card-warning">
            <div class="card-header"> 
                <div class="card-tools" style="float: left;">
                    <?= Html::button('Add Evaluation Type', ['value' => Url::to(['evaluation-types/create', 'AppraisalPeriod'=>$model->AppraisalPeriodId]),
                     'title' => 'Add Evaluation Type', 'class' => 'btn btn-primary  btn-flat border-primary showModalButton']); ?>
                </div>
            </div>
            <div class="card-body">
                <table class="table tabe-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Evaluation Type2 </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($model->evaluationTypes as $EvaluationTypes): ?>
                            <tr>
                                <th class="text-center"></th>
                                <td><b><?= $EvaluationTypes->Description ?></b></td>

                                <td class="text-center">
                                    <?php   $url = Url::to(['/evaluation-types/delete', 
                                                'id' => $EvaluationTypes->EvaluationTypeId,
                                                ]);
                                    ?>
                                    <?= Html::a('Remove', $url, [
                                            'title' => 'Remove Starategic Objective', 
                                            'class'=>'btn btn-danger', 
                                            'data-method' => 'POST'
                                        ]);
                                    ?>
                            
                                        <?= Html::button('Edit', ['value' => Url::to(['evaluation-types/update', 'id'=>$EvaluationTypes->EvaluationTypeId]),
                                        'title' => 'Edit Evaluation Type', 
                                            'class' => 'btn btn-success  
                                        btn-flat border-primary showModalButton'
                                        ]); 
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach;?>	
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
