<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobGroups */

$this->title = 'Create Job Groups';
$this->params['breadcrumbs'][] = ['label' => 'Job Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
