<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\CorporateWorkPlan */

$this->title = $model->CorporateWorkPlanId;
$this->params['breadcrumbs'][] = ['label' => 'Corporate Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="corporate-work-plan-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    
    <div class="headert" style="float: left;">
        <?= Html::a("<<<<< Go Back", ['/corporate-work-plan/submitted'], ['class'=>'btn btn-warning grid-button']) ?>
    </div>
  <br>
 
    <br>

    <div class="container-fluid">
	<div id="msg"></div>
    <div class="col-lg-12">
        <div class="card card-outline card-success">
            <div class="card-header">

            </div>
            <div class="card-body">
            <form action="" id="manage-user">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="name">Work Plan No</label>
			<input type="text" name="firstname" id="firstname" class="form-control" value="<?= $model->CorporateWorkPlanId ?>" readonly required>
		</div>
		<div class="form-group">
			<label for="name">Strategic Plan Period</label>
			<input type="text" name="lastname" id="lastname" class="form-control" value="<?= $model->StrategicPlanId ?>" readonly required>
		</div>

	</form>
            </div>
        </div>
    </div>
	

</div>

    <div class="col-lg-12">
        <div class="card card-outline card-success">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table class="table tabe-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Objective Id</th>
                            <th>StrategicObjectiveId</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($model->corporateStrategicObjectives as $CorporateStrategicObjective): ?>
                            <tr>
                                <th class="text-center"></th>
                                <td><b><?= $CorporateStrategicObjective->CorporateObjectiveId ?></b></td>
                                <td><b><?= $CorporateStrategicObjective->StrategicObjectiveId ?></b></td>


                            </tr>
                        <?php endforeach;?>	
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


