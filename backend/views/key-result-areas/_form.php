<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PscRating;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model common\models\KeyResultAreas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="key-result-areas-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'TaskDescription')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'AppraiseeRemarks')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'SelfRating')->dropDownList(
        ArrayHelper::map(PscRating::find()->all(),
        'Rating','Description'),
        ['prompt'=>'Choose Rating',
        'disabled'=>true])
     ?>

    <?= $form->field($model, 'Achievements')->textInput(['readonly'=>true, 'id'=>'achievements']) ?>

    <?php if(!$model->Ontime):?>
        <?= $form->field($model, 'Ontime')->textInput() ?>

        <?= $form->field($model, 'FaultReason')->textInput(['readonly'=>true]) ?>

    <?php endif;?>

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

    <?php if(!$model->Ontime):?>
        <?= $form->field($model, 'Ontime')->textInput() ?>

        <?= $form->field($model, 'FaultReason')->textInput(['id'=>'FaultReason']) ?>

    <?php endif;?>

    <?= $form->field($model, 'ImprovementAreas')->textInput(['rows' => 6, 'id'=>'ImprovementAreas']); ?>

    <?php if($model->areasOfImprovements):?>
        <table class="table table-sm">
            <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>

                    </tr>
            </thead>
            <?php foreach($model->areasOfImprovements as $x => $Area):?>           
                    <tbody>
                        <tr>
                        <th scope="row"><?=$x?></th>
                        <td><?= $Area->Description ?></td>
                        <td>  
                         <?= Html::a('Remove', ['/areas-of-improvement/delete', 'id' => $Area->AreaImprovementId], [
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
<script>

jQuery( document ).ready(function( $ ) {
     //Tokenize some input on behind schedule reasons		
    // console.log('Hapa');
    // $('#ImprovementAreas, #FaultReason').tokenfield({			 
    //       showAutocompleteOnFocus: true
    // });

});

</script>