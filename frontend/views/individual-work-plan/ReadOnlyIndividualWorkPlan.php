<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// echo '<pre>';
// print_r($model->corporateWorkPlan->Code);
// exit;
/* @var $this yii\web\View */
/* @var $model common\models\CorporateWorkPlan */

$this->title = $model->Description;
$this->params['breadcrumbs'][] = ['label' => 'Corporate Work Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="corporate-work-plan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="headert" style="float: left;">
        <?= Html::a('<span>Print Workplan</span>&nbsp;&nbsp;<i class="fa fa-print"></i>',
        ['/individual-work-plan/workplan',
        'IndividualWorkPlanId'=>$model->IndividualWorkPlanId,], 
        ['value' => '', 'class' => 'btn btn-warning',
        'data-method' => 'POST',
        'title' => 'Print Workplan','target'=>'_blank'])
        ?>
    </div>
  <br>
 
    <div class="card-body">
        <form action="" id="manage-user">	
                    <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
                   
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="name">Individual Work Plan No</label>
                                <input type="text" name="firstname" readonly id="firstname" class="form-control" value="<?= $model->Code ?>" required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                            <label for="name">Department WorkPlan No</label>
                                <input type="text" name="lastname"  readonly id="lastname" class="form-control" value="<?= $model->deptWorkPlan->Code?>" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="name">Description</label>
                                <input type="text" name="lastname"  readonly id="lastname" class="form-control" value="<?= $model->Description?>" required>
                            </div>
                        </div>
                   
                    </div>



                </form>
    </div>

</div>

<div class="row"> 
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <!-- <th>Corporate Objectives</th> -->
                        <th>Directorate Objectives</th>
                        <th> </th>
                        <th>Individual Objectives</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $DepartmentObjectives = $model->deptWorkPlan->departmentObjectives;
                    $CorporateObjectives =  $model->deptWorkPlan->corporateWorkPlan->corporateStrategicObjectives;

                    foreach($CorporateObjectives as $CorporateObjective){
                        $so_arr[$CorporateObjective['StrategicObjectiveId']] =  $CorporateObjective->ObjectiveName;
                        // echo '<pre>';
                        // echo 'CorporateObjectives Objectives';
                        // print_r($model->deptWorkPlan->DepartmentWorkPlanId);
                        // exit;
                    }
                    

                    ?>
                    <?php if(sizeof($DepartmentObjectives)): ?>
                        <?php  foreach($DepartmentObjectives as $DepartmentObjective):?>
                            <?php  foreach($CorporateObjectives as $CorporateObjective): ?>
                            <?php endforeach; ?>
                                <tr>
                                    <!-- <td><?= $CorporateObjective->ObjectiveName ?></td> -->
                                    <td><?= $DepartmentObjective->ObjectiveName?></td>
                                    <td> 
                                    
                                    <td>
                                        <table class="table">
                                            <?php if(sizeof($model->individualObjectives)): ?>
                                                <?php foreach($model->individualObjectives as $IndividualObjective):?>
                                                    <?php
                                                                                            // echo '<pre>';
                                                                                            // echo 'individualObjectives Objectives';
                                                                                            // print_r($IndividualObjective);
                                                                                            // exit;         
                                                                ?>
                                                    <tr>
                                                        <?php if($IndividualObjective->DepartmentObjId == $DepartmentObjective->DepartmentObjectiveId): ?>
                                                            <td>
                                                                <?php
                                                                                //    echo '<pre>';
                                                                                //    print_r('Hapa');
                                                                                //    exit;
                                                                ?>
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td> <?= $IndividualObjective->IndividualObjectiveName ?></td>
                                                                     
                                                                       
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <?= $IndividualObjective->workplan_weight. '%'?></th>
                                                                        </tr>
                                                                        <td> 
                                                                 

                                                                        </td>
                                   

                                                                        
                                                                            
                                                                    </tbody>
                                                                </table>
                                                            </td>

                                                            <td>
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Task/ Activity Description</th>
                                                                            <th></th>
                                                                            <th>Resources Required</th>
                                                                            <th>Key Performance Indicators</th>
                                                                            <th>Expected Output</th>
                                                                            <th>Timeline</th>
                                                                            <th>Weight (%)</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <?php if(sizeof($IndividualObjective->tasks)): ?>
                                                                        <?php foreach($IndividualObjective->tasks as $Task): ?>
                                                                            <tr>
                                                                                <?php if($Task->IndividualObjectiveId == $IndividualObjective->IndividualObjectiveId): ?>
                                                                                    <td>
                                                                                        <table class="table">
                                                                                            <tbody>
                                                                                                <tr class>
                                                                                                    <td><?= $Task->TaskDescription ?></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                    <td>  
                                                                                     </td>

                                                                                    <td>
                                                                                        <?php $ResourcesRequired = explode(',',$Task->ResourcesRequired); ?>
                                                                                        <?php foreach($ResourcesRequired as $Resource): ?>
                                                                                            <table class="table">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><?= $Resource ?></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        <?php endforeach; ?>
                                                                                    
                                                                                    </td>

                                                                                    <td>
                                                                                        <?php $KPIS = explode(',',$Task->KPI); ?>
                                                                                        <?php foreach($KPIS as $KPI): ?>
                                                                                            <table class="table">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><?= $KPI ?></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                                
                                                                                            </table>
                                                                                        <?php endforeach; ?>
                                                                                    </td>

                                                                                    <td>
                                                                                        <?php $ExpectedOutPut = explode(',',$Task->ExpectedOutPut); ?>
                                                                                        <?php foreach($ExpectedOutPut as $ExpectedOutPut): ?>
                                                                                            <table class="table">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><?= $ExpectedOutPut ?></td>
                                                                                                    </tr>
                                                                                                </tbody>   
                                                                                            </table>
                                                                                        <?php endforeach; ?>

                                                                                    </td>  
                                                                                    <td><?= Yii::$app->formatter->asDate($Task->Timeline, 'long'); ?></td> 
                                                                                    <td><?= $Task->weight ?></td>
                                                                            </tr>
                                                                                <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>

                                                                </table>
                                                            </td>
                                                            <!-- <td> <p>Update Individual Objective Button</p>
                                                                
                                                                <p> Delete Individual Obj Button</p>
                                                            </td> -->
                                                    </tr>
                                                    <tr>
                
                                                    </tr>
                                                        <?php endif; ?>

                                                 <?php endforeach; ?>
                                                
                                            <?php endif;?>
                                                
                                        </table>
                                    </td>

                                </tr>
                        <?php  endforeach; ?>
                    <?php endif; ?>
                        <!-- <tr>
                            <td>Create IND oBJ bUTTON</td>
                        </tr>
                        <tr>
                            <th>No Departmental Objectives Set</th>
                        </tr> -->

                </tbody>
            </table>
        </div>
    </div>
</div>

</div>


