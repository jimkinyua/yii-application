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

    <div class="headert" style="float: right;">
        <?= Html::a('Submit To Staff', [
            '/department-work-plans/submit',
            'DepartmentWorkPlanId'=> $model->DepartmentWorkPlanId], 
             ['class'=>'btn btn-success grid-button',
             'data-method' => 'POST'])
         ?>
    </div>
  <br>
 
    <div class="card-body">
        <form action="" id="manage-user">	
                    <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
                   
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="name">Department Work Plan No</label>
                                <input type="text" name="firstname" readonly id="firstname" class="form-control" value="<?= $model->Code ?>" required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                            <label for="name">Corporate WorkPlan No</label>
                                <input type="text" name="lastname"  readonly id="lastname" class="form-control" value="<?= $model->corporateWorkPlan->Code?>" required>
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

    <div class="col-lg-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="card-tools">
                    <?= Html::button('Add Departmental Objectives', ['value' => Url::to(['department-objectives/create'
                            , ' CorporateWorkPlanId'=>$model->CorporateWorkPlanId,
                            'DepartmentWorkPlanId'=>$model->DepartmentWorkPlanId]),
                            'title' => 'Add Departmental Objectives', 
                            'class' => 'btn btn-block btn-sm btn-default btn-flat border-primary showModalButton']);
                     ?>
                </div>
            </div>
            <div class="card-body">
                <table class="table tabe-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Departmental Objective Id</th>
                            <th>Strategic Objective Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // echo '<pre>';
                        // print_r($model->departmentObjectives);
                        // exit;


                        ?>
                        <?php foreach($model->departmentObjectives as $DepartmentObjective): ?>
                            <tr>
                                <th class="text-center"></th>
                                <td><b><?= $DepartmentObjective->ObjectiveName ?></b></td>
                                <td><b><?= $DepartmentObjective->StrategicObjectiveId ?></b></td>

                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                    </button>
                                    <div class="dropdown-menu" style="">
                                    <a class="dropdown-item view_employee" href="javascript:void(0)" data-id=>View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./index.php?page=edit_employee&id=">Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_employee" href="javascript:void(0)" data-id=>Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;?>	
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


