<?php

namespace backend\controllers;

use Yii;
use common\models\Evaluations;
use frontend\models\Employee;
use common\models\ScoreMatrix;
use backend\models\EvaluationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Results;

/**
 * EvaluationsController implements the CRUD actions for Evaluations model.
 */
class EvaluationsController extends Controller
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
     * Lists all Evaluations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EvaluationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubmitted()
    {
        $searchModel = new EvaluationsSearch();
        $dataProvider = $searchModel->search([$searchModel->formName()=>['Status'=>1]]);
        $dataProvider->query->where('Evaluations.Status = 1');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEvaluate($EvaluationId)
    {
        $ScoreMatrix = ScoreMatrix::find()->all();
        return $this->render('SupervisorEvaluate', [
            'model' => $this->findModel($EvaluationId),
            'ScoreMatrix'=>$ScoreMatrix
        ]);
    }

    /**
     * Displays a single Evaluations model.
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
     * Creates a new Evaluations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Evaluations();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->EvaluationId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSubmitreview($workplan_score,$EmpNo,$Supervisor, $softskills_score, $performanceskills_score, 
    $corevalues_score,$evalId,$type,$rating,  $period, $excellent)
    {
        $ResultsModel = new Results();

            $ResultsModel->EmployeeNo = $EmpNo;
            $ResultsModel->AppraisalPeriodId = $period;
            $ResultsModel->EvaluationId = $evalId;
            $ResultsModel->EvaluationType = $type;
            $ResultsModel->Supervisor = $Supervisor;
            $ResultsModel->SupervisorDesignation = 
            $ResultsModel->Rating = $rating;
            $ResultsModel->WorkPlanScore = $workplan_score;
            $ResultsModel->SoftSkillsScore = $softskills_score;
            $ResultsModel->PerformanceSkillsScore = $performanceskills_score;
            $ResultsModel->CoreValuesScore = $corevalues_score;
            $ResultsModel->Excellent = $excellent;

            if($ResultsModel->save()){
                $model = $this->findModel($evalId);
                $model->Status = 4; //Reviewed
                $model->save();
                Yii::$app->session->setFlash('success', "Reviewed Succesfully"); 
                return $this->redirect(['submitted']);
            }
            // echo '<pre>';
            // print_r($ResultsModel->geterrors());
            // exit;


        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }


    /**
     * Updates an existing Evaluations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->EvaluationId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Evaluations model.
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
     * Finds the Evaluations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Evaluations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evaluations::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
