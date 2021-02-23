<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CorporateStrategicObjectives */

$this->title = 'Create Corporate Strategic Objectives';
$this->params['breadcrumbs'][] = ['label' => 'Corporate Strategic Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corporate-strategic-objectives-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
