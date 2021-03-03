<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// echo '<pre>';
// print_r($model->corporateWorkPlan->Code);
// exit;
/* @var $this yii\web\View */
/* @var $model common\models\CorporateWorkPlan */

$this->title = $model->Scale;
$this->params['breadcrumbs'][] = ['label' => 'Corporate Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="corporate-work-plan-view">

    <h1><?= Html::encode($this->title) ?></h1>

  <br>
 
    <div class="card-body">
        <form action="" id="manage-user">	
                   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Job Group</label>
                                <input type="text" name="firstname" readonly id="firstname" class="form-control" value="<?= $model->Scale ?>" required>
                            </div>
                        </div>
                   
                    </div>
                    <div class="row">

                    <div class="card-header">
                        <div class="card-tools">
                            <?= Html::button('Add Target Types', ['value' => Url::to(['job-group-target-types/create'
                                    , 'JobGroupId'=>$model->Scale,]),
                                    'title' => 'Add Target Types', 
                                    'class' => 'btn btn-primary showModalButton']);
                            ?>
                        </div>
                    </div>

                    </div>



                </form>
                
    </div>

</div>

    <div class="col-lg-12">
        <div class="card card-outline card-success">
          
            <div class="card-body">
                <table class="table tabe-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Target Type </th>
                            <!-- <th>Target Type</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // echo '<pre>';
                        // print_r($model->departmentObjectives);
                        // exit;


                        ?>
                        <?php foreach($model->jobGroupTargetTypes as $jobGroupTargetType): ?>
                            <tr>
                                <th class="text-center"></th>
                                <td><b><?= $jobGroupTargetType->targetType->TargetType ?></b></td>
                                <td><b><?= 
                                            Html::a('Remove', 
                                            [Url::to(['job-group-target-types/delete',
                                                    'id'=>$jobGroupTargetType->Id,])], 
                                                    ['value' => Url::to(['job-group-target-types/delete',
                                                    'id'=>$jobGroupTargetType->Id,]), 
                                                    'class' => 'btn btn-danger',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to delete?',
                                                        'method' => 'post',
                                                    ],'title' => 'Remove'])
                                    ?></b>
                                </td>
                            </tr>
                        <?php endforeach;?>	
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


