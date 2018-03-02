<?php

namespace app\controllers;

use Yii;
use app\models\Courses;
use app\models\CoursesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * CoursesController implements the CRUD actions for Courses model.
 */
class CoursesController extends Controller
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
     * Lists all Courses models.
     * @return mixed
     */
    public function actionIndex()
   {
       if (Yii::$app->user->can('admin')){
        $searchModel = new CoursesSearch();
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
     * Displays a single Courses model.
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
                   $courses = Courses::find()
                        ->where(['dept_id' => $id])
                        ->all();
            
                if (!empty($courses)) {
        
        
                    foreach($courses as $course) {

  
                        echo " <div class='checkbox'><label><input name= 'course_id[]' type= 'checkbox' value='".$course->course_id."'>".$course->course_name."</label></div>";
                    }
                } else {
                    echo "<option>-</option>";
                }}
            else{
                throw new ForbiddenHttpException;
            }     


        
    
    }

    /**
     * Creates a new Courses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       if (Yii::$app->user->can('admin')) {$model = new Courses();
        
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->course_id]);
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
     * Updates an existing Courses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('admin')){$model = $this->findModel($id);
        
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->course_id]);
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
     * Deletes an existing Courses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('admin')){$this->findModel($id)->delete();
        
                return $this->redirect(['index']);}
        else{
                throw new ForbiddenHttpException;
            }
    }

    /**
     * Finds the Courses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Courses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Courses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
