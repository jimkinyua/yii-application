<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KeyResultAreas */

$this->title = 'Update Key Result Areas: ' . $model->KeyResultAreaId;
$this->params['breadcrumbs'][] = ['label' => 'Key Result Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->KeyResultAreaId, 'url' => ['view', 'id' => $model->KeyResultAreaId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="key-result-areas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
