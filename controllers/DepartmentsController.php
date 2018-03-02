<?php

namespace app\controllers;

use Yii;
use app\models\Departments;
use app\models\DepartmentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * DepartmentsController implements the CRUD actions for Departments model.
 */
class DepartmentsController extends Controller
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
     * Lists all Departments models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('admin')){
            $searchModel = new DepartmentsSearch();
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
     * Displays a single Departments model.
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


    public function actionLists($id){ 
                       
        if (Yii::$app->user->can('register-course')){
                $departments = Departments::find()->where(['fac_id' => $id])->all();
 
        if (!empty($departments)) {

            foreach($departments as $department) {
                echo "<option value='".$department->dept_id."'>".$department->dept_name."</option>";
            }
        } else {
            echo "<option>-</option>";
        }

        }
        else{
             throw new ForbiddenHttpException;
         }

        
 
    }

    /**
     * Creates a new Departments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('admin')){
             $model = new Departments();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->dept_id]);
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
     * Updates an existing Departments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('admin')){
              $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->dept_id]);
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
     * Deletes an existing Departments model.
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
     * Finds the Departments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Departments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Departments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
