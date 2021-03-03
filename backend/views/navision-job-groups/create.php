<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NavisionJobGroups */

$this->title = 'Create Navision Job Groups';
$this->params['breadcrumbs'][] = ['label' => 'Navision Job Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="navision-job-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
