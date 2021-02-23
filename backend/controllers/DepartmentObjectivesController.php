<?php

namespace backend\controllers;

use Yii;
use common\models\DepartmentObjectives;
use common\models\DepartmentObjectivesSearch;
use common\models\DepartmentWorkPlans;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * DepartmentObjectivesController implements the CRUD actions for DepartmentObjectives model.
 */
class DepartmentObjectivesController extends Controller
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
     * Lists all DepartmentObjectives models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentObjectivesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DepartmentObjectives model.
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

 

    /**
     * Creates a new DepartmentObjectives model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($CorporateWorkPlanId, $DepartmentWorkPlanId)
    {
        $model = new DepartmentObjectives();
        $DepartmentWorkPlansModel = DepartmentWorkPlans::findone($DepartmentWorkPlanId);


        $CorporateObjectives = $DepartmentWorkPlansModel->corporateWorkPlan->corporateStrategicObjectives;
        foreach($CorporateObjectives as $CorporateObjective){
            $Rss [] = [
                'StrategicObjectiveId'=>$CorporateObjective->StrategicObjectiveId,
                'ObjectiveName'=>$CorporateObjective->ObjectiveName,
            ];
        }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form', [
                        'model' => $model,
                        'CorporateObjectives'=>$Rss
            ]);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->DepartmentId = 11;
            $model->DepartmentWorkPlanId = $DepartmentWorkPlanId;
            if($model->save()){
                return $this->redirect(Yii::$app->request->referrer);
            }
            return $this->redirect(['view', 'id' => $model->StrategicObjectiveId]);
        }

        // DepartmentId
        // 


    }

    /**
     * Updates an existing DepartmentObjectives model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->DepartmentObjectiveId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DepartmentObjectives model.
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
     * Finds the DepartmentObjectives model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DepartmentObjectives the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DepartmentObjectives::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
