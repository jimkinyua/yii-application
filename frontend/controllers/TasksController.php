<?php

namespace frontend\controllers;

use Yii;
use common\models\Tasks;
use common\models\TasksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
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
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tasks model.
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
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($IndividualObjectiveId)
    {
        $model = new Tasks();

                //Total weight assigned
         $weight = (new \yii\db\Query())->select(" sum(weight) as total")
             ->from('Tasks')->where(['IndividualObjectiveId'=>$IndividualObjectiveId])->all();
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

        if ($model->load(Yii::$app->request->post()) ) {
            $model->IndividualObjectiveId = $IndividualObjectiveId;
            $model->save();
            return $this->redirect(Yii::$app->request->referrer);

            // return $this->redirect(['view', 'id' => $model->TaskId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($TaskId)
    {
        $model = $this->findModel($TaskId);

        $weight = (new \yii\db\Query())->select(" sum(weight) as total")
             ->from('Tasks')->where(['IndividualObjectiveId'=>$model->IndividualObjectiveId])->all();
        
             $assigned_weight = ($weight[0]['total'] - $model->weight);
            
            if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form', [
                        'model' => $model,
                        'a_weight'=>$assigned_weight
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);

            // return $this->redirect(['view', 'id' => $model->TaskId]);
        }


    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($TaskId)
    {
        $this->findModel($TaskId)->delete();
        return $this->redirect(Yii::$app->request->referrer);

        // return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
