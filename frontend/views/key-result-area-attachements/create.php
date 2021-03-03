<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StrategicObjectives */

$this->title = 'Create Strategic Objectives';
$this->params['breadcrumbs'][] = ['label' => 'Strategic Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="strategic-objectives-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
