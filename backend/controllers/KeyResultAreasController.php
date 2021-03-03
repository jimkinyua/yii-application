<?php

namespace backend\controllers;

use Yii;
use common\models\KeyResultAreas;
use common\models\KeyResultAreasSearch;
use common\models\AreasOfImprovement;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KeyResultAreasController implements the CRUD actions for KeyResultAreas model.
 */
class KeyResultAreasController extends Controller
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
     * Lists all KeyResultAreas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KeyResultAreasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KeyResultAreas model.
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
     * Creates a new KeyResultAreas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KeyResultAreas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->KeyResultAreaId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing KeyResultAreas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax){
            $model->ImprovementAreas = '';
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

        if ($model->load(Yii::$app->request->post())) {
            // echo '<pre>';
            // print_r($model);
            // exit;

            if($model->save()){
                $ImprovementAreasModel = new AreasOfImprovement();
                $ImprovementAreasModel->KeyResultId = $id;
                $ImprovementAreasModel->Description= $model->ImprovementAreas;
                $ImprovementAreasModel->EmpNo = $model->evaluation->EmpNo;
                $ImprovementAreasModel->AppraisalPeriodid = $model->evaluation->AppraisalPeriodid;
                $ImprovementAreasModel->save();
                if(!$ImprovementAreasModel->save()){
                    echo '<pre>';
                    print_r($ImprovementAreasModel->geterrors());
                    exit;
                }
                                 
                }else{
                        echo '<pre>';
                        print_r($model->geterrors());
                        exit;
                }
                Yii::$app->session->setFlash('success', "Saved Succesfully"); 
                return $this->redirect(Yii::$app->request->referrer);      
          }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KeyResultAreas model.
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
     * Finds the KeyResultAreas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KeyResultAreas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KeyResultAreas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
