<?php

namespace frontend\controllers;

use Yii;
use common\models\Evaluations;
use common\models\AreasOfImprovement;
use common\models\TargetImprovementAreas;
use common\models\EvaluateTargetImprovementAreas;
use common\models\EvaluateTasksImprovementAreas;
use common\models\EvaluateTargets;
use frontend\models\EvaluationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\IndividualWorkPlan;
use common\models\EvaluationTypes;
use common\models\AppraisalPeriods;
use common\models\KeyResultAreas;
use common\models\Targets;
use common\models\JobGroupTargetTypes;
use common\models\ScoreMatrix;




/**
 * EvaluationsController implements the CRUD actions for Evaluations model.
 */
class EvaluationsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Evaluations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EvaluationsSearch();
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>0]]);
        $dataProvider->query->where('Evaluations.Status =0');
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubmitted()
    {
        $searchModel = new EvaluationsSearch();
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>1]]);
        $dataProvider->query->where('Evaluations.Status = 1');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionReviewed()
    {
        $searchModel = new EvaluationsSearch();
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>4]]);
        $dataProvider->query->where('Evaluations.Status = 4');
        return $this->render('ReviwedEvaluations', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionSubmit($EvaluationId){
        $model = $this->findModel($EvaluationId);

        $KeyResultAreas = $model->keyResultAreas;
        $EvaluateTargets = $model->evaluateTargets;

        foreach( $KeyResultAreas as $KeyResultArea){
            if(!$KeyResultArea->SelfRating){ 
                Yii::$app->session->setFlash('error', "Please Fill in the Entire Evaaluation Form before Submitting for Approval "); 
                return $this->redirect(Yii::$app->request->referrer);
            }
            foreach($EvaluateTargets as $EvaluateTarget){
                if(!$EvaluateTarget->SelfRating){ 
                    Yii::$app->session->setFlash('error', "Please Fill in the Entire Evaaluation Form before Submitting for Approval "); 
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }

        }
      
       $identity = \Yii::$app->user->identity;
        $model->Status = 1;
        $model->ImmediateSupervisor = $identity->supervisorno;

        if($model->save()){
            //TODO: Send Email Here Notifying Supervisor
            Yii::$app->session->setFlash('success', "Evalauation Succesfully Sent To Your Supervisor"); 
        }

        return $this->redirect('index');

    }

    /**
     * Displays a single Evaluations model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionReview($id)
    {
        return $this->render('AppraiseeReview', [
            'model' => $this->findModel($id),
            'ScoreMatrix' => ScoreMatrix::find()->all()
        ]);
    }

    /**
     * Creates a new Evaluations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($IndividualWorkPlanId)
    {
        $model = new Evaluations();

        if(Yii::$app->request->isAjax){
            //Get Appraisal Period Attached with the WorkPlan Id
            $IndividualWorkPlanModel = IndividualWorkPlan::findOne($IndividualWorkPlanId);
            $StrategicWorkPlan = $IndividualWorkPlanModel->deptWorkPlan->corporateWorkPlan->strategicPlan;
            // echo '<pre>';
            // print_r($StrategicWorkPlan->PlanId);
            // exit;

            //Get Appraisal Periods Associated with the Strategic Work Plan
            $AppraisalPeriods = $StrategicWorkPlan->appraisalPeriods;
            //Get Evaluation Types Associated with the Appraisal Periods
            foreach($AppraisalPeriods as $AppraisalPeriod){
               $EvalTypes = EvaluationTypes::find()
               ->where(['AppraisalPeriodId'=>$AppraisalPeriod->AppraisalPeriodId])
               ->asArray()->all();
            }
            $DropDownAppraisalPeriods = AppraisalPeriods::find()
            ->select('AppraisalPeriodId, Description')
            ->where(['StarategicPlanPeriod'=>$StrategicWorkPlan->PlanId])
            ->asArray()->all();


        
            return $this->renderAjax('create', [
                        'model' => $model,
                        'EvalTypes'=>$EvalTypes,
                        'DropDownAppraisalPeriods'=>$DropDownAppraisalPeriods
            ]);
        }


        if ($model->load(Yii::$app->request->post()) ) {
            $model->WorkPlanId = $IndividualWorkPlanId;
            $model->Contested = 0;
            $model->EmpNo = Yii::$app->user->identity->no;
            $model->ImmediateSupervisor = Yii::$app->user->identity->supervisorno;
            
             //Get Improvement Areas for Targets From Previous Evals That are not Closed
             $TasksImprovementAreas = AreasOfImprovement::find()
             ->where(['EmpNo'=>Yii::$app->user->identity->no,
                     'Addressed'=>NULL])
               ->asArray()->all(); 

               $TargetImprovementAreas = TargetImprovementAreas::find()
               ->where(['EmpNo'=>Yii::$app->user->identity->no,
                       'Addressed'=>0])
                 ->asArray()->all(); 

            //   echo '<pre>';
            //   print_r($TasksImprovementAreas);
            //   exit;


            // $model->save();
            if($model->save()){
                //Insert The Key Result Areas Lines
                $IndividualWorkPlanModel = IndividualWorkPlan::findone($model->WorkPlanId);
                $IndividualObjectives = $IndividualWorkPlanModel->individualObjectives;
                
                foreach($IndividualObjectives  as $IndividualObjective){
                    foreach( $IndividualObjective->tasks as $Task){
                        $KeyResultAreaModel = new KeyResultAreas();
                        $KeyResultAreaModel->TaskId = $Task->TaskId;
                        $KeyResultAreaModel->IndividualObjectiveId = $Task->IndividualObjectiveId;
                        $KeyResultAreaModel->EvaluationId =$model->EvaluationId;
                        $KeyResultAreaModel->TaskDescription =$Task->TaskDescription;
                        $KeyResultAreaModel->WorkPlanWeight = $Task->weight;

                        // $KeyResultAreaModel->save();
                        if(!$KeyResultAreaModel->save()){
                            echo '<pre>';
                            print_r($KeyResultAreaModel->getErrors());
                            exit;
    
                        }

                    }
                }
                //Insert The Targets

                //Get Target Types Asociated with the Job Group of the Employee
               $AssignedTargetTypes = JobGroupTargetTypes::find()
                    ->select('TargetTypeId')
                    ->where(['JobGroupId'=>Yii::$app->user->identity->level])
                    ->asArray()->all();
                    // echo'<pre>';
                    // print_r($AssignedTargetTypes[0]['TargetTypeId']);
                    // exit;

                //Get the Asssigned Targets and Add them to the Eval Targets Table
                foreach($AssignedTargetTypes as $AssignedTargetType){
                    $Targets = Targets::find()
                    ->where(['TargetTypeId'=>$AssignedTargetType['TargetTypeId']])
                    ->asArray()->all();

                    foreach($Targets as $Target){
                        
                        $EvaluateTargetsModel = new EvaluateTargets();
                        $EvaluateTargetsModel->WorkPlanId  = $IndividualWorkPlanId;
                        $EvaluateTargetsModel->TargetTypeId = $AssignedTargetType['TargetTypeId'];
                        $EvaluateTargetsModel->TargetId = $Target['TargetId'];
                        $EvaluateTargetsModel->EvaluationId = $model->EvaluationId;
                        $EvaluateTargetsModel->TargetDescription = $Target['TargetDescription'];
                        
                        // $EvaluateTargetsModel->save();
                        if(!$EvaluateTargetsModel->save()){

                       
                            echo '<pre>';
                            print_r($EvaluateTargetsModel->getErrors());
                            exit;
    
                        }
                    }

                }

                foreach($TargetImprovementAreas as $TargetImprovementArea){
                    // echo '<pre>';
                    // print_r($TargetImprovementArea);
                    // exit;

                    $EvaluateTargetImprovementAreasModel = new EvaluateTargetImprovementAreas();
                    $EvaluateTargetImprovementAreasModel->EvaluationId = $model->EvaluationId;
                    $EvaluateTargetImprovementAreasModel->Description = $TargetImprovementArea['Description'];
                    $EvaluateTargetImprovementAreasModel->Addressed = 0;
                    $EvaluateTargetImprovementAreasModel->TargetImprovementAreaId = $TargetImprovementArea['Id'];
                    $EvaluateTargetImprovementAreasModel->save();
                }

                foreach($TasksImprovementAreas as $TasksImprovementArea){
                    $EvaluateTasksImprovementAreasModel = new EvaluateTasksImprovementAreas();
                    $EvaluateTasksImprovementAreasModel->EvaluationId = $model->EvaluationId;
                    $EvaluateTasksImprovementAreasModel->Description = $TasksImprovementArea['Description'];
                    $EvaluateTasksImprovementAreasModel->Addressed = 0;
                    $EvaluateTasksImprovementAreasModel->TaskmprovementAreaId = $TasksImprovementArea['AreaImprovementId'];
                    $EvaluateTasksImprovementAreasModel->save();
                }

               

                return $this->redirect(['view', 'id' => $model->EvaluationId]);

            }
            echo '<pre>';
            print_r($model->geterrors());
            exit;
        }

      
    }

    public function actionEvaluationPeriods() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getSubCatList($cat_id); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    public function getSubCatList($id){
            $data = EvaluationTypes::find()->where(['AppraisalPeriodId'=>$id])
            ->select(['EvaluationTypeId','Description'])->asArray()->all();
            $value = (count($data) == 0) ? ['' => ''] : $data;
            if(count($data) > 0)
            {
            // var_dump($data);
            $cityname = array();
            $ci=0;
            foreach ($data as $k2 => $v2) {
            $cityname[$ci]['id']=$v2['EvaluationTypeId'];
            $cityname[$ci]['name']=$v2['Description'];
            $ci++;
            # code...
            }
            // var_dump($cityname);
            return $cityname;
            }
            return $value;
    }
     

    /**
     * Updates an existing Evaluations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->EvaluationId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Evaluations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Evaluations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Evaluations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evaluations::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
