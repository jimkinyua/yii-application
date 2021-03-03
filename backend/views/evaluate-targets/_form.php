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
        ['prompt'=>'Choose Rating',
        'disabled'=>true])
     ?>

    <?= $form->field($model, 'SupervisorRating')->dropDownList(
        ArrayHelper::map(PscRating::find()->all(),
        'Rating','Description'),
        ['prompt'=>'Choose Rating'])
     ?>

    <?= $form->field($model, 'AgreedScore')->dropDownList(
        ArrayHelper::map(PscRating::find()->all(),
        'Rating','Description'),
        ['prompt'=>'Choose Rating'])
     ?>

    <?= $form->field($model, 'SupervisorRemarks')->textInput() ?>

    <?= $form->field($model, 'TargetImprovementAreas')->textInput() ?>


    <?php if($model->targetImprovementAreas):?>
        <table class="table table-sm">
            <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>

                    </tr>
            </thead>
            <?php foreach($model->targetImprovementAreas as $x => $Area):?>           
                    <tbody>
                        <tr>
                        <th scope="row"><?=$x?></th>
                        <td><?= $Area->Description ?></td>
                        <td>  
                         <?= Html::a('Remove', ['/target-improvement-areas/delete', 'id' => $Area->Id], [
                                'class' => 'btn btn-danger DeleteItem',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                                ]) ?>
                        </td>
                        </tr>
                    </tbody>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
