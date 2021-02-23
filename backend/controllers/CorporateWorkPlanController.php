<?php

namespace backend\controllers;

use Yii;
use common\models\CorporateWorkPlan;
use common\models\CorporateWorkPlanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CorporateWorkPlanController implements the CRUD actions for CorporateWorkPlan model.
 */
class CorporateWorkPlanController extends Controller
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
     * Lists all CorporateWorkPlan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CorporateWorkPlanSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>0]]);
        $dataProvider->query->where('CorporateWorkPlan.Status =0');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CorporateWorkPlan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('UpdateCorporateWorkPlan', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CorporateWorkPlan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CorporateWorkPlan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CorporateWorkPlanId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CorporateWorkPlan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CorporateWorkPlanId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSubmit($CorporatetWorkPlanId)
    {
        $model = $this->findModel($CorporatetWorkPlanId);


            $model->Status = 1;
            $model->save();

            //TODO: Send Email Here Notifying Employees
            return $this->redirect('index');

            // return $this->render('update', [
            //     'model' => $model,
            // ]);
    }

    public function actionReadonly($id)
    {
        return $this->render('ReadOnlyCorporateObjective', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionSubmitted()
    {
        $searchModel = new CorporateWorkPlanSearch();
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>1]]);
        $dataProvider->query->where('CorporateWorkPlan.Status = 1');
        return $this->render('SubmitttedCorporateWorkPlans', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Deletes an existing CorporateWorkPlan model.
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
     * Finds the CorporateWorkPlan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CorporateWorkPlan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CorporateWorkPlan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
