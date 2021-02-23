<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualObjectives */

$this->title = 'Create Individual Objectives';
$this->params['breadcrumbs'][] = ['label' => 'Individual Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individual-objectives-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
