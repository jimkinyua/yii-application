<?php

namespace frontend\controllers;

use Yii;
use common\models\IndividualWorkPlan;
use common\models\IndividualWorkPlanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;


/**
 * IndividualWorkPlanController implements the CRUD actions for IndividualWorkPlan model.
 */
class IndividualWorkPlanController extends Controller
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
     * Lists all IndividualWorkPlan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IndividualWorkPlanSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>0]]);
        $dataProvider->query->where('IndividualWorkPlan.Status =0');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IndividualWorkPlan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('UpdateIndividualWorkPlan', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new IndividualWorkPlan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($DepartmentWorkPlanId)
    {
        $model = new IndividualWorkPlan();

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form', [
                        'model' => $model,
            ]);
        }

        if ($model->load(Yii::$app->request->post()) ) {
            $model->EmpNo = Yii::$app->user->identity->no;
            $model->DeptWorkPlanId = $DepartmentWorkPlanId;
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->IndividualWorkPlanId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing IndividualWorkPlan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->IndividualWorkPlanId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing IndividualWorkPlan model.
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

    public function actionSubmit($IndividualWorkPlanId){
        $model = $this->findModel($IndividualWorkPlanId);

        $Individualobjectives = $model->individualObjectives;
        $DepartmentObjectives = $model->deptWorkPlan->departmentObjectives;

        foreach( $DepartmentObjectives as $DepartmentObjective){
            foreach($Individualobjectives as $Individualobjective){
                if($DepartmentObjective->DepartmentObjectiveId == $Individualobjective->DepartmentObjId){
                    $Total = $Individualobjective->getTotalWeight($Individualobjective->DepartmentObjId);

                    if($Total < 100){ //Individual Objectives Not Fully Completed. 
                        Yii::$app->session->setFlash('error', "Please Fill in the Entire Work Plan before Submitting for Approval (Individual Objectives Do Not Add up to 100%"); 
                        return $this->redirect(Yii::$app->request->referrer);
                    }else{
                      
                        //Check If Tasks Are Also filled In
                        if($Individualobjective->taskTotalWeight <100){
                            Yii::$app->session->setFlash('error', "Please Fill in the Entire Work Plan before Submitting for Approval (Tasks Do Not Add Up to 100%)"); 
                            return $this->redirect(Yii::$app->request->referrer);

                        }
                      
                    }
                }                
            }
        }
      
       $identity = \Yii::$app->user->identity;
        $model->Status = 1;
        $model->ImmediateSupervisor = $identity->supervisorno;

        if($model->save()){
            //TODO: Send Email Here Notifying Supervisor
            Yii::$app->session->setFlash('success', "WorkPlan Succesfully Sent To Your Supervisor"); 
        }

        return $this->redirect('index');

    }

    public function actionSubmitted()
    {
        $searchModel = new IndividualWorkPlanSearch();
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>1]]);
        $dataProvider->query->where('IndividualWorkPlan.Status = 1');
        return $this->render('SubmittedIndividualPlans', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApproved()
    {
        $searchModel = new IndividualWorkPlanSearch();
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>3]]);
        $dataProvider->query->where('IndividualWorkPlan.Status = 3');
        return $this->render('ApprovedIndividualPlans', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionComments($IndividualWorkPlanId)
    {
        $model = $this->findModel($IndividualWorkPlanId);

        return '<h4> <p>'.$model->RejectReason. '</p> </h4>';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->IndividualWorkPlanId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionRejected()
    {
        $searchModel = new IndividualWorkPlanSearch();
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>3]]);
        $dataProvider->query->where('IndividualWorkPlan.Status = 3');
        return $this->render('RejectedIndividualPlans', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReadonly($id)
    {
        return $this->render('ReadOnlyIndividualWorkPlan', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionWorkplan($IndividualWorkPlanId){
        $IndividualWorkPlan = $this->findModel($IndividualWorkPlanId);

        $Individualobjectives = $IndividualWorkPlan->individualObjectives;

        if($Individualobjectives ){
            foreach($Individualobjectives  as $Individualobjective){
                $Tasks = $Individualobjective->tasks;
            }
        }else{
            $Tasks = [];
        }
    

        $DepartmentObjectives = $IndividualWorkPlan->deptWorkPlan->departmentObjectives;
        if($DepartmentObjectives){
            foreach($DepartmentObjectives as $DepartmentObjective){
                $CorporateObjectives  = $DepartmentObjective->strategicObjective;
            }
        }else{
            $CorporateObjectives = [];

        }
        // echo '<pre>';
        // print_r($Tasks);
        // exit;

        $content = $this->renderPartial('workplan',[
            'CorporateObjectives'=> $CorporateObjectives,
            'DepartmentObjectives'=>$DepartmentObjectives,
            'Individualobjectives' => $Individualobjectives,
            'model'=>$IndividualWorkPlan,
            'Tasks' => $Tasks,
        ]);

        $pdf = \Yii::$app->pdf;
        $pdf->content = $content;
        $pdf->format = Pdf::FORMAT_TABLOID;
        $pdf->orientation = Pdf::ORIENT_PORTRAIT;


        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/pdf');


        return $pdf->render();

        

    }

    /**
     * Finds the IndividualWorkPlan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IndividualWorkPlan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IndividualWorkPlan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
