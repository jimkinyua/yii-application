<?php

namespace frontend\controllers;

use Yii;
use common\models\IndividualObjectives;
use common\models\IndividualObjectivesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IndividualObjectivesController implements the CRUD actions for IndividualObjectives model.
 */
class IndividualObjectivesController extends Controller
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
     * Lists all IndividualObjectives models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IndividualObjectivesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IndividualObjectives model.
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
     * Creates a new IndividualObjectives model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($IndividualWorkPlanId, $DepartmentObjId)
    {
        $model = new IndividualObjectives();

             //Total weight assigned
         $weight = (new \yii\db\Query())->select(" sum(workplan_weight) as total")
             ->from('IndividualObjectives')->where(['IndvidualWorkplanId'=>$IndividualWorkPlanId,'DepartmentObjId'=>$DepartmentObjId])->all();
        // echo '<pre>';
        // print_r($weight );
        // exit;
             $assigned_weight = $weight[0]['total'];

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form', [
                        'model' => $model,
                        'a_weight'=>$assigned_weight
            ]);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->IndvidualWorkplanId = $IndividualWorkPlanId;
            $model->DepartmentObjId = $DepartmentObjId;
            $model->save();
            
            return $this->redirect(Yii::$app->request->referrer);

            // return $this->redirect(['view', 'id' => $model->IndividualObjectiveId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing IndividualObjectives model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($IndividualObjectiveId)
    {
        // exit($IndividualObjectiveId);
        $model = $this->findModel($IndividualObjectiveId);
   

        $weight = (new \yii\db\Query())->select(" sum(workplan_weight) as total")
             ->from('IndividualObjectives')->where(['IndvidualWorkplanId'=>
             $model->IndvidualWorkplanId,'DepartmentObjId'=>$model->DepartmentObjId])
             ->all();
        
        $assigned_weight = ($weight[0]['total'] - $model->workplan_weight);
        //      echo '<pre>';
        // print_r($assigned_weight);
        // exit;
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('update', [
                        'model' => $model,
                        'a_weight'=>$assigned_weight
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);

            // return $this->redirect(['view', 'id' => $model->IndividualObjectiveId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing IndividualObjectives model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($IndividualObjectiveId)
    {
        $this->findModel($IndividualObjectiveId)->delete();
        return $this->redirect(Yii::$app->request->referrer);

        // return $this->redirect(['index']);
    }

    /**
     * Finds the IndividualObjectives model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IndividualObjectives the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IndividualObjectives::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
