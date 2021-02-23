<?php

namespace backend\controllers;

use Yii;
use common\models\DepartmentWorkPlans;
use common\models\DepartmentWorkPlansSearch;
use common\models\CorporateStrategicObjectives;
use common\models\DepartmentObjectives;
use common\models\CorporateWorkPlan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DepartmentWorkPlansController implements the CRUD actions for DepartmentWorkPlans model.
 */
class DepartmentWorkPlansController extends Controller
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
                    'submit'=>['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all DepartmentWorkPlans models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentWorkPlansSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>0]]);
        $dataProvider->query->where('DepartmentWorkPlans.Status =0');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DepartmentWorkPlans model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('UpdateDepartmentObjectives', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function actionReadonly($id)
    {
        return $this->render('ReadOnlyDepartmentObjectives', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new DepartmentWorkPlans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($CorporateWorkPlanId)
    {
        $model = new DepartmentWorkPlans();

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form', [
                        'model' => $model,
                        // 'CorporateObjectives'=>$Rss
            ]);
        }

        // $CorporateWorkPlanModel = CorporateWorkPlan::findOne($CorporateWorkPlanId);
        if ($model->load(Yii::$app->request->post()) ) {
            $Post = Yii::$app->request->post('DepartmentWorkPlans');
            $model->CorporateWorkPlanId = $CorporateWorkPlanId;
            $model->Description = $Post['Description'];

            
            // echo '<pre>';
            // print_r( $Post['Description']);
            // exit;

            if($model->save()){
                //Insert The Lines Now. All the Starategic Objectives On The Corporporate Work PLans
                // foreach($CorporateWorkPlanModel->corporateStrategicObjectives as $CorporateStrategicObjectives){
                //     $DepartmentObjectivesModel = new DepartmentObjectives();
                //     $DepartmentObjectivesModel->StrategicObjectiveId = $CorporateStrategicObjectives->StrategicObjectiveId;
                //     $DepartmentObjectivesModel->DepartmentWorkPlanId = $model->DepartmentWorkPlanId;
                //     $DepartmentObjectivesModel->DepartmentId = 11;
                //     $DepartmentObjectivesModel->save();
                // }
                return $this->redirect(['view', 'id' => $model->DepartmentWorkPlanId]);
    
            }else{
                echo '<pre>';
                print_r($model->getErrors());
                exit;

            }

        }
      
        // return $this->redirect(['view', 'id' => $model->DepartmentWorkPlanId]);

        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }

    public function actionSubmitted()
    {
        $searchModel = new DepartmentWorkPlansSearch();
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>1]]);
        $dataProvider->query->where('DepartmentWorkPlans.Status = 1');
        return $this->render('SubmittedDepartmentPlans', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubmit($DepartmentWorkPlanId)
    {
        $model = $this->findModel($DepartmentWorkPlanId);


            $model->Status = 1;
            $model->save();

            //TODO: Send Email Here Notifying Employees

            return $this->redirect('index');

            // $searchModel = new DepartmentWorkPlansSearch();
            // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            // return $this->render('index', [
            //     'searchModel' => $searchModel,
            //     'dataProvider' => $dataProvider,
            // ]);
  

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DepartmentWorkPlans model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->DepartmentWorkPlanId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DepartmentWorkPlans model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($DepartmentWorkPlanId)
    {
        $this->findModel($DepartmentWorkPlanId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DepartmentWorkPlans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DepartmentWorkPlans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DepartmentWorkPlans::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
