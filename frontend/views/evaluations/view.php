<?php
/**
 * Created by PhpStorm.
 * User: Francis
 * Date: 5/30/2018
 * Time: 2:57 AM
 */

use yii\widgets\ActiveForm;
use common\models\Employees;
use common\models\Evaluations;
use common\models\EvaluationTypes;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\IndividualWorkplans;
use common\models\AppraisalPeriod;
// use c\models\Comments;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\url;
use yii\web\UploadedFile;

/* @var $this yii\web\View */

$this->title = 'SASRA WORKPLAN EVALUATION';
//  $contested = \Yii::$app->evaluation->contested($evalId); 
                          
                        
$identity = Yii::$app->user->identity;
// echo '<pre>';
// print_r($model->perfomanceSkills);
// exit;
$employee_number = $identity->no;

?>
<div class="row">

 

<div class="col">

        <div class="col-md-3">
            <div class="box box-success">
               
                <div class="box-body">
                    
                    <?php
                    //$model = Evaluations::findOne(['appraisal_code'=>\Yii::$app->request->get('wpCode'),'period_code_id'=>\Yii::$app->request->get('period')]);
                    $form = ActiveForm::begin(['id'=>'submit-eval']); ?>
                    <?= $form->field($model, 'status')->hiddenInput(['value'=>1])->label(false);?>
                    <div class="headert" style="float: right;">
                        <?= Html::a('Submit To Supevisor', [
                            '/evaluations/submit',
                            'EvaluationId'=> $model->EvaluationId], 
                            ['class'=>'btn btn-success grid-button',
                            'data-method' => 'POST'])
                        ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    <!--workplan evaluation-->
    <div class="box box-success box-solid collapsed-box0" id="box-wp">
            <div class="box-header with-border">
                <h3 class="box-title">Employee Workplan Evaluation  </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            
            </div>
            <div class="box-body">
                <?php
                    $wp = '<table class="table">
                                <tbody>';
                                    $totalwp_score = 0;
                                    $totaltaskscore = 0;
                                    $total_task_weighted_score =0;
                                    $objweight = 0;

                                        foreach($model->workPlan->individualObjectives as $obj){
                                            $wp .='<tr>
                                                                <td>
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <h3> '.$obj->IndividualObjectiveName.'</h3>
                                                                            </tr>
                                                                            <th class="bg-green ">
                                                                            Weight <span class="label bg-yellow">'.$obj->workplan_weight.' % </span>
                                                                            </th>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                
                                                                    <td>
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <h4> <th> Task Description </th> </h4>
                                                                                
                                                                                    <h4>  <th>Weight of Task</th> </h4>
                                                                                    <h4>  <th class="">Appraisee Score</th> </h4>

                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>';
                                           
                                            foreach($model->keyResultAreas as $tsk){
                                                if($tsk->IndividualObjectiveId === $obj->IndividualObjectiveId){
                                                    //Get identity of assigned task---> very vital
                                                    $evaluation_id = $model->EvaluationId;
                                                    $totaltaskscore += $tsk->SelfRating;
                                                    $task_self_eval = checkTask($tsk->KeyResultAreaId,$evaluation_id,'self');
                                                    if($tsk->SelfRating){
                                                        $title = 'Update Score';
                                                        $buttonstyle = 'btn btn-warning showModalButton';
                                                    }else{
                                                        $title = 'Self Evaluate';
                                                        $buttonstyle = 'btn btn-success showModalButton';
                
                
                                                    }
                                                    // echo '<pre>';
                                                    // print_r( $task_self_eval);
                                                    // exit;
                                                    $class= null;
                                                
                                                    $Selfstyle='border-left:2px solid #f39c12;';
                                                    $evalurl="/key-result-areas/update?id=$tsk->KeyResultAreaId";
                                                    $wp .='<tr style="'.$Selfstyle.'">
                                                                                <td >
                                                                                <h3> '.$tsk->TaskDescription.' </h3>
                                                                                </td>
                                                                               
                                                                                <td style="border-left:2px solid #f39c12;">
                                                                                    <span class="label label-info bg-white"> <h3> '.$tsk->WorkPlanWeight.'%'.'</h3>  </span>
                                                                                </td>
                                                                                <td style="border-left:2px solid #f39c12;" >
                                                                                <h3 class=""> '.$tsk->SelfRating.' </h3>
                                                                                </td>
                                                                                <td style="border-left:2px solid #f39c12;">'.

                                                                                    Html::button($title,
                                                                                        [  'value' => Url::to(['key-result-areas/update',
                                                                                            'id'=>$tsk->KeyResultAreaId,]),
                                                                                            'title' => 'Self Evaluate',
                                                                                            'class' => $buttonstyle,
                                                                                            ]
                                                                                        ).
                                                                                '</td>
                                                                            </tr>';
                                                    // if($task_self_eval== 0){
                                                        $appraisee_score = accessEval($tsk->KeyResultAreaId,$evaluation_id,'SelfRating');
                                                        // echo '<pre>';
                                                        // print_r();
                                                        // exit;
                                                        
                                                        $supervisor_score = accessEval($tsk->KeyResultAreaId,$evaluation_id,'SupervisorRating');
                                                        $appraisee_remarks = accessEval($tsk->KeyResultAreaId,$evaluation_id,'AppraiseeRemarks');
                                                        $supervisor_remarks = accessEval($tsk->KeyResultAreaId,$evaluation_id,'SupervisorRemarks');
                                                        $agreed_score = accessEval($tsk->KeyResultAreaId,$evaluation_id,'AgreedScore');
                                                        $weight = accessEval($tsk->KeyResultAreaId,$evaluation_id,'AgreedScore');
                                                        // $evidence = accessEval($tsk->KeyResultAreaId,$evaluation_id,'Evidence_File');
                                                        // echo '<pre>';
                                                        // print_r($agreed_score);
                                                        // exit;

                                                        $weighted_score = ($agreed_score * $tsk->WorkPlanWeight/100);
                                                        $total_task_weighted_score += $weighted_score;
                                                        $wp .='<tr>
                                                                                       ';
                                                        
          

                                                        $wp .='</tr>
                                                                                        ';
                                                        $wp .='<tr>
                                                                                
                                                                                <td colspan="3">
                                                                                <div class="box box-solid box-success collapsed-box">
                                                                                        <div class="box-header with-border  ">
                                                                                            <div class="box-tools pull-right">
                                                                                                <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-minus"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                      
                                                                                    </div>
                                                                                </td>
                                                                        </tr>
                                                                        ';
                                                    // }
                                                    
                                                }
                                            }

                                            $wp .='</tbody>
                                                                        </table>
                                                                    </td>
                                                            </tr>';
                                        

                                        }

                                        $totalwp_score += $objweight;
                                        $weighted_wpscore = weightwp($totalwp_score,70);

                                        $totalwp_score += $objweight;
                                        $weighted_wpscore = weightwp($totalwp_score,70);
                        
                                    $wp .='<tr class="bg-warning">
                                                        <th>Workplan Score (100%) </th>
                                                        <td>'.$totalwp_score.'</td>
                                                </tr>
                                    <tr class="bg-warning">
                                                        <th>Weighted Workplan Score (70%) </th>
                                                        <td>'.$weighted_wpscore.'</td>
                                                </tr>';
                                                $objweight = objweight($total_task_weighted_score,$tsk->SelfRating);
                                                $wp .='<tr class="bg-warning">
                                                                        <th>Total Tasks Score</th>
                                                                        <td colspan="2">'.$objweight.'</td>
                                                                    </tr>';
                                        
                                $wp .="</tbody>
                            </table>";

                    print $wp;

                ?>
            </div><!--end box body-->
    </div><!--end box>
        end workplan evaluation-->
</div>

</div>

    <div class="row">

        <div class="col">
            <div class="box box-success box-solid collapsed-box0"><!--evaluate softskills-->
                <div class="box-header with-border">
                    <h3 class="box-title">Soft Skills Evaluation</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table">
                            <?php
                            $total = 0;
                            if(count($model->softSkills)){
                                $total = 0;
                                foreach($model->softSkills as $soft){
                                    // echo '<pre>';
                                    // print_r($soft);
                                    // exit;
                                    $total += $soft->SelfRating;;
                                    $soft_self_eval = true;// checkTarget($soft->Id,$model->EvaluationId,'self');
                                    $class= null;
                                    $currentevalid = $model->EvaluationId;
                                    $targetid = $soft->Id;

                                    if($soft->SelfRating){
                                        $title = 'Update Score';
                                        $buttonstyle = 'btn btn-warning showModalButton';
                                    }else{
                                        $title = 'Self Evaluate';
                                        $buttonstyle = 'btn btn-success showModalButton';


                                    }

                                    $Selfstyle='border-left:2px solid #f39c12;';
                                    $Superstyle='border-right:2px solid #35AC19';

                                    echo '<tr style="'.$Selfstyle.' '.$Superstyle.'">
                                        <td >'.$soft->TargetDescription.'</td>
                                        <td >'.Html::button($title,
                                                [  'value' => Url::to(['evaluate-targets/update',
                                                    'id'=>$soft->Id,]),
                                                    'title' => 'Self Evaluate',
                                                    'class' => "$buttonstyle",
                                                    ]
                                                ).
                                        '</td>
                                    </tr>';
                                }

                                // if(isset($soft['evaluation'][0]['supervisor_rating'] ) && $soft['evaluation'][0]['self_rating']>0 && $soft_counter >0 ){
                                    $weighted = ($total)/1;
                                    print '<tr>
                                                        <th style="text-align: right;color: #f39c12;">Total Score</th><th>'.($total).'</th>
                                        </tr>
                                        ';
                                    $scoresoft = ceil(targetWeighted($weighted,10));
                                // }

                            }
                            else{
                                echo '<tr>
                                        <td>No SoftSkills Set for Evaluation</td>
                                </tr>';
                            }
                            ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="box box-success box-solid collapsed-box0"><!--evaluate softskills-->
                <div class="box-header with-border">
                    <h3 class="box-title">SASRA Core Values Evaluation</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table">
                            <?php
                            $total = 0;
                            if(count($model->coreValues)){
                                /*print '<pre>';
                                print_r($corevalues);
                                print '</pre>';exit;*/
                                $core_counter = $total =  0;
                                foreach($model->coreValues as $core){
                                    $total += $core->SelfRating;
                                    $core_self_eval = true; 
                                    $class=null;
                                    $targetid = $core->Id;
                                    
                                    if($core->SelfRating){
                                        $title = 'Update Score';
                                        $buttonstyle = 'btn btn-warning showModalButton';
                                    }else{
                                        $title = 'Self Evaluate';
                                        $buttonstyle = 'btn btn-success showModalButton';


                                    }
                                    $Selfstyle='border-left:2px solid #f39c12;';
                                    $Superstyle='border-right:2px solid #35AC19';
                                    //(isset($core['evaluation'][0][0]->supervisor_rating) && $core['employee_number'] == $employee_number)?$Superstyle='border-right:2px solid #35AC19':$Superstyle='';
                                    echo '
                                    <tr style="'.$Selfstyle.' '.$Superstyle.'">
                                        <td>'.$core->TargetDescription.'</td>
                                            <td>'.Html::button($title,
                                                    [  'value' => Url::to(['evaluate-targets/update',
                                                        'id'=>$core->Id,]),
                                                        'title' => 'Self Evaluate',
                                                        'class' => "$buttonstyle",
                                                        ]
                                                    ).
                                            '</td>
                                        </tr>
                                        ';
                                

                                }  

                                    // if(isset($soft['evaluation'][0]['supervisor_rating'] ) && $soft['evaluation'][0]['self_rating']>0 && $soft_counter >0 ){
                                        $weighted = ($total)/1;
                                        print '<tr>
                                                            <th style="text-align: right;color: #f39c12;">Total Score</th><th>'.($total).'</th>
                                            </tr>
                                            ';
                                        $scoresoft = ceil(targetWeighted($weighted,10));
                                    // }

                            }
                            else{
                                echo '<tr>
                                        <td>No Core Values Set for Evaluation</td>
                                </tr>';
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="box box-success box-solid collapsed-box0"><!--evaluate softskills-->
                <div class="box-header with-border">
                    <h3 class="box-title">Performance Skills Evaluation</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table">
                            <?php
                             $total =  0;
                            if(count($model->perfomanceSkills)){
                                foreach($model->perfomanceSkills as $p){
                                    $perf_self_eval = true; // checkTarget($p->Id,$model->EvaluationId,'self');
                                    $total += $p->SelfRating;
                                    if($p->SelfRating){
                                        $title = 'Update Score';
                                        $buttonstyle = 'btn btn-warning showModalButton';
                                    }else{
                                        $title = 'Self Evaluate';
                                        $buttonstyle = 'btn btn-success showModalButton';
                                    }
                                    $Selfstyle='border-left:2px solid #f39c12;';
                                    $Superstyle='border-right:2px solid #35AC19';

                                    echo '
                                        <tr style="'.$Selfstyle.' '.$Superstyle.'">
                                            <td>'.$p->TargetDescription.'</td>

                                            <td>'.Html::button($title,
                                                    [  'value' => Url::to(['evaluate-targets/update',
                                                        'id'=>$p->Id,]),
                                                        'title' => 'Self Evaluate',
                                                        'class' => "$buttonstyle",
                                                        ]
                                                    ).
                                            '</td>
                                        </tr>
                                        ';
                                
                                }
                                    $weighted = ($total)/1;
                                    print '<tr>
                                                        <th style="text-align: right;color: #f39c12;">Total Score</th><th>'.($total).'</th>
                                        </tr>
                                        ';
                                    $scoresoft = ceil(targetWeighted($weighted,10));
                            }
                            else{
                                echo '<tr>
                                        <td>No Performance Skills Set for Evaluation</td>
                                </tr>';
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="box box-success box-solid collapsed-box0">
                <div class="box-header with-border">
                    <h3 class="box-title">Targets Improvement Areas</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table">
                            <?php
                             $total =  0;
                            if(count($model->evaluateTargetImprovementAreas)){
                                foreach($model->evaluateTargetImprovementAreas as $p){
                                    // echo '<pre>';
                                    // print_r($p);
                                    // exit;

                                    $perf_self_eval = true; // checkTarget($p->Id,$model->EvaluationId,'self');
                                    $total += $p->SelfRating;
                                    if($p->SelfRating){
                                        $title = 'Update Score';
                                        $buttonstyle = 'btn btn-warning showModalButton';
                                    }else{
                                        $title = 'Self Evaluate';
                                        $buttonstyle = 'btn btn-success showModalButton';
                                    }
                                    $Selfstyle='border-left:2px solid #f39c12;';
                                    $Superstyle='border-right:2px solid #35AC19';

                                    echo '
                                        <tr style="'.$Selfstyle.' '.$Superstyle.'">
                                            <td>'.$p->Description.'</td>

                                            <td>'.Html::button($title,
                                                    [  'value' => Url::to(['evaluate-target-improvement-areas/update',
                                                        'id'=>$p->Id,]),
                                                        'title' => 'Self Evaluate',
                                                        'class' => "$buttonstyle",
                                                        ]
                                                    ).
                                            '</td>
                                        </tr>
                                        ';
                                
                                }
                                    $weighted = ($total)/1;
                                    print '<tr>
                                                        <th style="text-align: right;color: #f39c12;">Total Score</th><th>'.($total).'</th>
                                        </tr>
                                        ';
                                    $scoresoft = ceil(targetWeighted($weighted,5));
                            }
                            else{
                                echo '<tr>
                                        <td>No Targets Improvement Areas From Previous Evaluations </td>
                                </tr>';
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="box box-success box-solid collapsed-box0">
                <div class="box-header with-border">
                    <h3 class="box-title">Tasks Improvement Areas</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table">
                            <?php
                             $total =  0;
                            if(count($model->evaluateTasksImprovementAreas)){
                                foreach($model->evaluateTasksImprovementAreas as $p){
                                    // echo '<pre>';
                                    // print_r($p);
                                    // exit;

                                    $perf_self_eval = true; // checkTarget($p->Id,$model->EvaluationId,'self');
                                    $total += $p->SelfRating;
                                    if($p->SelfRating){
                                        $title = 'Update Score';
                                        $buttonstyle = 'btn btn-warning showModalButton';
                                    }else{
                                        $title = 'Self Evaluate';
                                        $buttonstyle = 'btn btn-success showModalButton';
                                    }
                                    $Selfstyle='border-left:2px solid #f39c12;';
                                    $Superstyle='border-right:2px solid #35AC19';

                                    echo '
                                        <tr style="'.$Selfstyle.' '.$Superstyle.'">
                                            <td>'.$p->Description.'</td>

                                            <td>'.Html::button($title,
                                                    [  'value' => Url::to(['evaluate-target-improvement-areas/update',
                                                        'id'=>$p->Id,]),
                                                        'title' => 'Self Evaluate',
                                                        'class' => "$buttonstyle",
                                                        ]
                                                    ).
                                            '</td>
                                        </tr>
                                        ';
                                
                                }
                                    $weighted = ($total)/1;
                                    print '<tr>
                                                <th style="text-align: right;color: #f39c12;">Total Score</th><th>'.($total).'</th>
                                        </tr>
                                        ';
                                    $scoresoft = ceil(targetWeighted($weighted,5));
                            }
                            else{
                                echo '<tr>
                                        <td>No Tasks Improvement Areas From Previous Evaluations </td>
                                </tr>';
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($weighted_wpscore) && isset($scoresoft) && isset($scorecore) && isset($scoreperf)):
        /*echo $totalwp_score.'<br>';
        echo $scoresoft.'<br>';
        echo $scorecore.'<br>';
        echo $scoreperf.'<br>';*/
        $rating = $weighted_wpscore+$scoresoft+$scoreperf+$scorecore;
        ?>
        <div class="box box-success box-solid collapsed-box0">
            <div class="box-header with-border">
                <h3 class="box-title">Workplan Appraisal Summary</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <?php
                if($identity->accounttype == 3 && !$result_test) { //supervisor
                    //mark evaluation as reviewed
                    echo Html::a('Mark as Reviewed', ['/site/submitreview','workplan_score'=>$weighted_wpscore,'softskills_score'=>$scoresoft,'performanceskills_score'=>$scoreperf,'corevalues_score'=>$scorecore,'evalId' => Yii::$app->request->get('evalId'), 'code' => Yii::$app->request->get('wpCode'), 'type' => Yii::$app->request->get('type'), 'rating' => $rating,'period'=>Yii::$app->request->get('period'),'excellent'=>0], ['class' => 'btn btn-default review', 'style' => 'margin-left: 30px', 'title' => 'Submit Appraisal as Completed and Fully Reviewed']);
                    echo Html::a('Award 101%', ['/site/submitreview','workplan_score'=>$weighted_wpscore,'softskills_score'=>$scoresoft,'performanceskills_score'=>$scoreperf,'corevalues_score'=>$scorecore,'evalId' => Yii::$app->request->get('evalId'), 'code' => Yii::$app->request->get('wpCode'), 'type' => Yii::$app->request->get('type'), 'rating' => $rating,'period'=>Yii::$app->request->get('period'),'excellent'=>1 ], ['class' => 'btn btn-default excellent', 'style' => 'margin-left: 30px', 'title' => 'Award Appraisee 101 % - Excellent Performance']);

                }
                ?>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
                        <th>Workplan </th><td><?=  $weighted_wpscore ?></td>
                    </tr>
                    <tr>
                        <th>Soft Skills</th><td><?= $scoresoft  ?></td>
                    </tr>
                    <tr>
                        <th>Core Values</th><td><?= $scorecore ?></td>
                    </tr>
                    <tr>
                        <th>Performance Skills</th><td><?= $scoreperf ?></td>
                    </tr>
                    <tr>
                        <th style="text-align: right;color: #f39c12;">Total Evaluation Score</th><th style="text-align: right;color: #f39c12;"><?= $rating ?></th>
                    </tr>
                </table>
            </div>
        </div>
        <!----display total achievement in relation to score matrix -->
        <div class="box box-warning box-solid collapsed-box0">
        <div class="box-header">
            <h3 class="box-title">Appraisee Score and accompanying Reward/Sanction action</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <?php if(count($scorematrix)){ ?>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Performance Name</th>


                        <th>Performance Description</th>

                        <th>Score Range</th>


                        <th>Proposed Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php


                    foreach ($scorematrix as $sm){
                        $style = score($rating,$sm['id']);
                        echo '<tr '.$style.' >
                                        <td>'.$sm['performance_name'].'</td>
                                    
                                
                                        <td>'.$sm['performance_desc'].'</td>
                                    
                                    
                                        <td>'.$sm['score_range'].'</td>
                                    
                                    
                                        <td>'.$sm['action'].'</td>
                                    </tr>';
                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    <?php } endif; ?>
    <?php if($identity->accounttype == 2 && \Yii::$app->request->get('period') && \Yii::$app->params['evalSubmission'] !== 1 && \Yii::$app->params['evalSubmission'] < 1){ ?>
       
    <?php } ?>

<!--comments section-->


<?php
function rate($a,$b){ //just getting the scores and getting the average
    return ($a+$b)/2;
}
function score($score,$scoreId){
    $score = (int)$score;
    $matrixId = (new \yii\db\Query())
        ->select('id')
        ->from('scoreMatrix')
        ->Where(new \yii\db\conditions\BetweenColumnsCondition($score,'BETWEEN','min','max'))
        ->all();
//var_dump($matrixId[0]['id']);exit;
    $id = $matrixId[0]['id'];
    if($id == $scoreId && $score < 100){
        $style = 'class="bg-red" style="font-weight:bold"';
    }
    else if($id == $scoreId && $score > 100){
        $style = 'class="bg-green" style="font-weight:bold"';
    }
    else{
        $style ='';
    }
    return $style;

}
//end condition checking if a workplan/appraisal period is set
$script = <<< JS
    $(function(){
            $('.eval-task').click(function(){ 
             var disabled = $(this).attr('disabled');
             if(disabled == 'disabled'){
                 return false ;
             }
            $('#task-eval-modal').modal('show')
            .find('#task-eval-modal-content')
            .load($(this).attr('href'));
            return false;
        });
            $('.eval-comp').click(function(){ 
                
                
             var disabled = $(this).attr('disabled');
             if(disabled == 'disabled'){
                 return false ;
             }
                
            $('#target-eval-modal').modal('show')
            .find('#target-eval-modal-content')
            .load($(this).attr('href'));
            return false;
        });
            /*Training needs form dialog*/
            $('.tneeds').click(function(){ 
            $('#remark-modal').modal('show')
            .find('#remark-modal-content')
            .load($(this).attr('href'));
            return false;
        });
            /*Comments modal*/
            $('.comments').click(function(){ 
            $('#comments-modal').modal('show')
            .find('#comments-modal-content')
            .load($(this).attr('href'));
            return false;
        });
            /*Areas of improvement form dialog*/
            $('.ai').click(function(){ 
            $('#remark-modal').modal('show')
            .find('#remark-modal-content')
            .load($(this).attr('href'));
            return false;
        });
        
            $('#task-eval-modal,#target-eval-modal,#remark-modal,#comments-modal').on('hidden.bs.modal',function(){
                var reld = location.reload(true);
                setTimeout(reld,1000);
            });
            //submit evaluation
            $('.message').hide();
            $('#submit-eval').on('beforeSubmit',function(e){        
                    var \$form = $(this);
                    $.post(\$form.attr('action'),\$form.serialize()).done(function(res){
                        console.log(res.message);
                        if(res.message == 1){
                            $('.message').show();
                            $(\$form).hide();
                            $(document).find('.message').html('<strong>Evaluation Submitted Successfully.</strong>');
                            var reld = location.reload(true);
                            setTimeout(reld,5000);
                        }     
                        if(res.message !== 1){
                            $('.message').show();
                            $(document).find('.message').html('Server Error.');
                        }          
                    });
                    return false;
            });
            //Review the evaluation and save results
            $('.review').on('click',function(e){
                e.preventDefault();
                //alert($(this).attr('href'));
                $.get($(this).attr('href')).done(function(res){
                    console.log(res.message);
                    if(res.message == 1){
                        alert('Evaluation Reviewed Successfully');
                         var reld = location.reload(true);
                          setTimeout(reld,1000);
                    }
                    else if(res.message == 2){
                        alert('Evaluation Already Reviewed & Saved.');
                        var reld = location.reload(true);
                          setTimeout(reld,1000);
                    }
                    else if(res.message !== 1){
                        alert('Problem Saving Review! Sorry!!');
                    }
                });
            });
            
            $('#box-wp').click(function(){
               var p = $('#box-wp').hasClass('collapsed-box');
                if(p){
                    //alert('i');
                }    
                
            });


            //contest Eval results

            $('a.contest').on('click',function(){

                var eval = $(this).attr('rel');
                //alert(eval);
                $.post('../site/contest',{'eval':eval}).done(function(res){
                    alert(res.note);
                    location.reload(true);
                    });
                return false;
            });

            //uncontest Eval results
             $('a.uncontest').on('click',function(){
                var eval = $(this).attr('rel');
                //alert(eval);
                 $.post('../site/uncontest',{'eval':eval}).done(function(res){
                    alert(res.note);
                    location.reload(true);
                });
                return false;
            });
            
    });
    
    
JS;
$this->registerJs($script);
$this->registerCss("

");
function weightwp($totalwp_score,$wp_weight){//for workplan rating
    $result = ($totalwp_score * $wp_weight/100); //proportion of 70%
    return ceil($result);
}
function targetWeighted($agreed,$weight){
    $result = ($agreed * $weight)/5;
    return $result;
}

//Evaluation look function, simpler implementation than a lookup table/model
function checkEval($taskid,$evalid){//check whether task is evaluated
    $status = \common\models\KeyResultAreas::find()->where(['KeyResultAreaId'=>$taskid,'EvaluationId'=>$evalid])->exists();
    return $status;
}

function checkTask($taskId,$evalId,$lookuptype = 'self | supervisor | done'){
    $thresh = 0;
    switch($lookuptype){
        case 'self':
            $status = \common\models\KeyResultAreas::find()->where(['KeyResultAreaId'=>$taskId,'EvaluationId'=>$evalId])->andWhere(['>','SelfRating',$thresh])->count();
            break;
        case 'supervisor':
            $status = \common\models\KeyResultAreas::find()->where(['KeyResultAreaId'=>$taskId,'EvaluationId'=>$evalId])->andWhere(['>','SupervisorRating',$thresh])->count();
            break;
        case 'done':
            $status =\common\models\KeyResultAreas::find()->where(['KeyResultAreaId'=>$taskId,'EvaluationId'=>$evalId])->andWhere(['>','SelfRating',$thresh])->andWhere(['>','SupervisorRating',$thresh])->count();
            break;
    }

    return $status;
}
function accessEval($taskId,$evalId,$attribute){
    $query = \common\models\KeyResultAreas::find()->where(['KeyResultAreaId'=>$taskId,'EvaluationId'=>$evalId])->one();
    $attr = $query->$attribute;
    if($attr){
        $value = $attr;
    }else{
        $value= 0;
    }
    // echo '<pre>';
    // print_r( $query);
    // exit;

    return $value;
}
/*function checkTargets($targetid = 1002,$evalid = 1){//check whether target is evaluated
    $status = \frontend\models\EvaluateTarget::find()->select('id')->where(['assigned_target_id'=>$targetid,'eval_id'=>$evalid])->exists();
    return $status;
}*/
function checkTarget($targetId,$evalId,$lookuptype = 'self | supervisor | done'){
    $thresh = 0;
    $status = false;
    switch($lookuptype){
        case 'self':
            $status = \common\models\EvaluateTargets::find()->where(['Id'=>$targetId,'EvaluationId'=>$evalId])->andWhere(['>','SelfRating',$thresh])->count();
            break;
        case 'supervisor':
            $status = \common\models\EvaluateTargets::find()->where(['Id'=>$targetId,'EvaluationId'=>$evalId])->andWhere(['>','SupervisorRating',$thresh])->count();
            break;
        case 'done':
            $status =\common\models\EvaluateTargets::find()->where(['Id'=>$targetId,'EvaluationId'=>$evalId])->andWhere(['>','SelfRating',$thresh])->andWhere(['>','SupervisorRating',$thresh])->count();
            break;
    }

    return $status;
}

function taskEval($taskId,$eval=''){
    $thresh = 0;
    $eval = $model->EvaluationId;
    $val = \frontend\models\EvaluateTasks::find()->where(['Id'=>$taskId,'EvaluationId'=>$eval])->andWhere(['>','SelfRating',$thresh])->one();
    return $val;
}
function objweight($totaltaskweight,$objweight){
    $max = 5;
    $res = ($totaltaskweight/$max)*$objweight;
    return $res;
}

?>



