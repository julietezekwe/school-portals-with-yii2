<?php

namespace app\controllers;

use Yii;
use app\models\Faculty;
use app\models\FacultySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * FacultyController implements the CRUD actions for Faculty model.
 */
class FacultyController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Faculty models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('admin')){
            $searchModel = new FacultySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
         }
        else{
             throw new ForbiddenHttpException;
         }    
    }

    /**
     * Displays a single Faculty model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('admin')){
                return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else{
             throw new ForbiddenHttpException;
         } 
    }

    /**
     * Creates a new Faculty model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('admin')){
            $model = new Faculty();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->fac_id]);
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        }
        else{
             throw new ForbiddenHttpException;
         }     
    }

    /**
     * Updates an existing Faculty model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
       if (Yii::$app->user->can('admin')){
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->fac_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
             }
        }     
       else{
             throw new ForbiddenHttpException;
         }  
    }

    /**
     * Deletes an existing Faculty model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       if (Yii::$app->user->can('admin')){

           $this->findModel($id)->delete();

           return $this->redirect(['index']);
       }
       else{
             throw new ForbiddenHttpException;
       } 
    }

    /**
     * Finds the Faculty model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Faculty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faculty::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
