<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\CorporateWorkPlan */
// echo '<pre>';
// print_r($model->corporateStrategicObjectives[0]->strategicObjective);
// exit;


$this->title = $model->Description;
$this->params['breadcrumbs'][] = ['label' => 'Corporate Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="corporate-work-plan-view">

    <h1><?= Html::encode($this->title) ?></h1>

 
  <br>
    <!-- <div class="container-fluid"> -->
	<div id="msg"></div>
	
    <div class="col-lg-12">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">
                <form action="" id="manage-user">	
                    <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
                   
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="name"> Corporate Work Plan No</label>
                                <input type="text" name="firstname" readonly id="firstname" class="form-control" value="<?= $model->Code ?>" required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="name"> Description </label>
                                <input type="text" name="firstname" readonly id="firstname" class="form-control" value="<?= $model->Description ?>" required>
                            </div>
                        </div>
                   
                    </div>

                        
                    <div class="form-group">
                        <label for="name">Strategic Plan Period</label>
                        <input type="text" name="lastname" id="lastname" readonly class="form-control" value="<?= $model->strategicPlan->Name ?>" required>
                    </div>

                </form>
            </div>
        </div>
    </div>

	
<!-- </div> -->

    <div class="col-lg-12">
        <div class="card card-outline card-success">
            <div class="card-header"> 

            </div>
            <div class="card-body">
                <table class="table tabe-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Strategic Objective </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($model->corporateStrategicObjectives as $CorporateStrategicObjective): ?>
                            <tr>
                                <th class="text-center"></th>
                                <!-- <td><b><?= $CorporateStrategicObjective->CorporateObjectiveId ?></b></td> -->
                                <td><b><?= $CorporateStrategicObjective->strategicObjective->ObjectiveName ?></b></td>
                            </tr>
                        <?php endforeach;?>	
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


