<?php
/**
 * Created by PhpStorm.
 * User: Francis
 * Date: 5/16/2018
 * Time: 10:47 PM
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;


$this->title = 'SASRA APPRAISAL WORKPLAN';

$alias = Yii::getAlias('@frontend');//from common/bootstrap.php
$logolink = Url::to($alias.'/IITA-TAA-smallnew.png');
?>



<!-- <?= Html::img($logolink,['alt'=>'IITA LOGO','width'=>'200','height'=>'150','style'=>'align:center;padding:50px 400px;']); ?> -->
<h1 style="text-align: center">Individual WorkPlan </h1>


<?php
$identity = \Yii::$app->user->identity;

?>


<h2>Personal Details</h2>
<table class="table borderless details">
    <tbody>
        <tr>
            <th>Appriasee Name</th> <?= $identity->name ?><td></td>
            <th>Employee Number</th><td><?= $identity->no ?></td>
        </tr>
        <tr>
            <th>Designation</th> <td> <?= $identity->job ?> </td><th>Job Level</th><td><?= $identity->level ?></td>
        </tr>
        <tr>
            <th>Supervisor\'s Name</th><td><?= $identity->supervisor ?></td><th>Date</th><td> <?= Date('Y-M-d') ?></td>
        </tr>
    </tbody>
</table>

<table class="table">
    <thead>
        <tr>
            <th class="col-md-2">Strategic/Corporate Objectives</th>
            <th class="col-md-2">Department Objectives</th>
            <th class="col-md-10">Individual Objectives</th>
            
        </tr>
    </thead>
        <tbody>
            <div class="row"> 
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Corporate Objectives</th>
                                    <th>Directorate Objectives</th>
                                    <!-- <th> </th> -->
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
                                                <td><?= $DepartmentObjective->strategicObjective->ObjectiveName ?></td>
                                                <td><?= $DepartmentObjective->ObjectiveName?></td>
                                            
                                                
                                                <td>
                                                    <table class="table">
                                                        <?php if(sizeof($Individualobjectives)): ?>
                                                            <?php foreach($Individualobjectives as $IndividualObjective):?>
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
                                                                                        <p> <?= Html::button('Edit Individual Objective',
                                                                                                [  'value' => Url::to(['individual-objectives/update',
                                                                                                    'IndividualObjectiveId'=>$IndividualObjective->IndividualObjectiveId,]),
                                                                                                    'title' => 'Edit Individual Objective',
                                                                                                    'class' => 'btn btn-success  btn-flat border-warning showModalButton']); 
                                                                                            ?>
                                                                                        </p>
                                                                                        <p> <?= Html::a('Delete Individual Objective', [Url::to(['individual-objectives/delete',
                                                                                                                'IndividualObjectiveId'=>$IndividualObjective->IndividualObjectiveId,])], 
                                                                                                                ['value' => Url::to(['individual-objectives/delete',
                                                                                                                'IndividualObjectiveId'=>$IndividualObjective->IndividualObjectiveId,]), 
                                                                                                                'class' => 'label bg-red delete-task',
                                                                                                                'data' => [
                                                                                                                    'confirm' => 'Are you sure you want to delete this Individual Objective? This Will also Delete all the Tasks Associated with this Individual Objective',
                                                                                                                    'method' => 'post',
                                                                                                                ],'title' => 'Delete Individual Objective']);
                                                                                                                ?>
                                                                                        </p> 
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th> <?= $IndividualObjective->workplan_weight. '%'?></th>
                                                                                    </tr>
                                   
                                            

                                                                                    
                                                                                        
                                                                                </tbody>
                                                                            </table>
                                                                        </td>

                                                                        <td>
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Task/ Activity Description</th>
                                                                                        <th>Resources Required</th>
                                                                                        <!-- <th> </th> -->
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
                                                                                                <td> <B> <?= $Task->weight. '%'?> </B> </td>
                                                                                                    </TD> </TD>
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
        </tbody>
</table>
