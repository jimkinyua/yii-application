<?php

namespace backend\controllers;

use Yii;
use common\models\JobGroupTargetTypes;
use common\models\JobGroupTargetTypesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobGroupTargetTypesController implements the CRUD actions for JobGroupTargetTypes model.
 */
class JobGroupTargetTypesController extends Controller
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
     * Lists all JobGroupTargetTypes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JobGroupTargetTypesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JobGroupTargetTypes model.
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
     * Creates a new JobGroupTargetTypes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($JobGroupId)
    {
        $model = new JobGroupTargetTypes();

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('create', [
                        'model' => $model,
            ]);
        }

        
        if ($model->load(Yii::$app->request->post())) {
            $model->JobGroupId = $JobGroupId;
            // echo '<pre>';
            // print_r($model);
            // exit;

            if($model->save()){
                Yii::$app->session->setFlash('success', "Target Type Added Succesfully"); 
            }
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JobGroupTargetTypes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JobGroupTargetTypes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Target Type Removed Succesfully"); 

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the JobGroupTargetTypes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JobGroupTargetTypes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobGroupTargetTypes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
