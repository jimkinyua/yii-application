<?php

namespace frontend\controllers;

use Yii;
use common\models\KeyResultAreas;
use common\models\KeyResultAreasSearch;
use common\models\KeyResultAreaAttachements;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;



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
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

        // exit('jaj');
        if ($model->load(Yii::$app->request->post()) ) {
           

            if($model->save()){
            //Evidence files upload
            $upload_path = "C:\\inetpub\\wwwroot\\NewLookAppraisal\\yii-application\\frontend\\web\\uploads\\";
            $docs = UploadedFile::getInstances($model,'files');
            //store the source file name
            foreach ($docs as $doc) {
                $KeyResultAreaAttachementsModel = new KeyResultAreaAttachements();
                $KeyResultAreaAttachementsModel->DocName = $doc->baseName;
                $KeyResultAreaAttachementsModel->Url = $upload_path.''.$doc->name;
                $KeyResultAreaAttachementsModel->KeyResultId = $model->KeyResultAreaId;
                $KeyResultAreaAttachementsModel->Deleted = 0;
                $doc->saveAs($upload_path. $doc->name);
                if($KeyResultAreaAttachementsModel->save()){
                    
                }else{
                    echo '<pre>';
                    print_r($KeyResultAreaAttachementsModel->getErrors());
                    exit;
                }

            }
           
            Yii::$app->session->setFlash('success', "Saved Succesfully"); 
            return $this->redirect(Yii::$app->request->referrer);
           }else{
               echo '<pre>';
               print_r($model->getErrors());
               exit;

           }
            // return $this->redirect(['view', 'id' => $model->KeyResultAreaId]);
        }

       
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
