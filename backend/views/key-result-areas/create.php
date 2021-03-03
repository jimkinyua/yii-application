<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KeyResultAreas */

$this->title = 'Create Key Result Areas';
$this->params['breadcrumbs'][] = ['label' => 'Key Result Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-result-areas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
