<?php

namespace backend\controllers;

use Yii;
use common\models\EvaluateTargets;
use common\models\TargetImprovementAreas;
use common\models\EvaluateTargetsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EvaluateTargetsController implements the CRUD actions for EvaluateTargets model.
 */
class EvaluateTargetsController extends Controller
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
     * Lists all EvaluateTargets models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EvaluateTargetsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EvaluateTargets model.
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
     * Creates a new EvaluateTargets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EvaluateTargets();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EvaluateTargets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // echo'<pre>';
            $m= Yii::$app->request->post('EvaluateTargets');
            // print_r($m['TargetImprovementAreas']);
            // exit;
            if(isset($m['TargetImprovementAreas'])){
                // exit('1');
                $TargetImprovementAreas = new TargetImprovementAreas();
                $TargetImprovementAreas->TargetId = $id;
                $TargetImprovementAreas->Description= $m['TargetImprovementAreas'];
                $TargetImprovementAreas->EmpNo = $model->evaluation->EmpNo;
                $TargetImprovementAreas->AppraisalPeriodid = $model->evaluation->AppraisalPeriodid;
                $TargetImprovementAreas->Addressed = 0;
                $TargetImprovementAreas->save();
                if(!$TargetImprovementAreas->save()){
                    echo '<pre>';
                    print_r($TargetImprovementAreas->geterrors());
                    exit;
                }
            }      
                             
        }else{
                echo '<pre>';
                print_r($model->geterrors());
                exit;
        }
            Yii::$app->session->setFlash('success', "Saved Succesfully"); 
            return $this->redirect(Yii::$app->request->referrer); 

    }
    

    /**
     * Deletes an existing EvaluateTargets model.
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
     * Finds the EvaluateTargets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EvaluateTargets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EvaluateTargets::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
