<?php

namespace backend\controllers;

use Yii;
use common\models\CorporateStrategicObjectives;
use common\models\CorporateStrategicObjectivesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CorporateStrategicObjectivesController implements the CRUD actions for CorporateStrategicObjectives model.
 */
class CorporateStrategicObjectivesController extends Controller
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
     * Lists all CorporateStrategicObjectives models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CorporateStrategicObjectivesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CorporateStrategicObjectives model.
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
     * Creates a new CorporateStrategicObjectives model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($WorkPlanId)
    {
        $model = new CorporateStrategicObjectives();
        
        if ($model->load(Yii::$app->request->post()) ) {
            $model->CorporateWorkPlanId = $WorkPlanId;
            if( $model->save()){
                return $this->redirect(Yii::$app->request->referrer);
            }
        } 
        if(Yii::$app->request->isAjax){
                return $this->renderAjax('_form', [
                            'model' => $model
                ]);
        }
    
        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Updates an existing CorporateStrategicObjectives model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CorporateObjectiveId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CorporateStrategicObjectives model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(Yii::$app->request->referrer);

        // return $this->redirect(['index']);
    }

    /**
     * Finds the CorporateStrategicObjectives model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CorporateStrategicObjectives the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CorporateStrategicObjectives::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
