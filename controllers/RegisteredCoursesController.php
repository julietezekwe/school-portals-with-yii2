<?php

namespace app\controllers;

use Yii;
use app\models\RegisteredCourses;
use app\models\Courses;
use app\models\Faculty;
use app\models\Departments;
use app\models\Portalsuser;
use app\models\RegisteredCoursesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * RegisteredCoursesController implements the CRUD actions for RegisteredCourses model.
 */
class RegisteredCoursesController extends Controller
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

     public function actionWelcome()
    { 
      $id = yii::$app->user->identity->id;
      $check = RegisteredCourses::find()->where(['user_id'=>$id])->all();
      $status = RegisteredCourses::findOne(['user_id' => $id, 'status' => 'pending']);
      if (empty($status)) {
               $message=' Status: Your courses have been approved';               
           }

           else{
            $message = "Status:Your courses awaits admins approval";
          }

     if (!empty($check)) {
            $searchModel = new RegisteredCoursesSearch();
            $dataProvider = $searchModel->search($check);
            
            return $this->render('welcome', [
            'message' =>$message,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);

         
     }
     
     else{
       return $this->render('welcome');
     }
     
        
    
    }


    /**
     * Lists all RegisteredCourses models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('admin')){
            
            $model = RegisteredCourses::find()->where(['status'=>'pending'])->all();
            
            $searchModel = new RegisteredCoursesSearch();
            $dataProvider = $searchModel->search($model );
            

            return $this->render('index', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
       else{
             throw new ForbiddenHttpException;
         } 
 
    }


    public function actionReview($id){
        $model = RegisteredCourses::find()->where(['user_id' => $id])->all();

        return $this->render('review', ['model' => $model]);

    }

    /**
     * Displays a single RegisteredCourses model.
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
     * Creates a new RegisteredCourses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
          

   
  
    

    public function actionCreate($id)
    {
         if (Yii::$app->user->can('register-course')){
            
                $model = new RegisteredCourses();                  
                   
                if (Yii::$app->request->                     {
                            $reg_info=Yii::$app->request->post()["RegisteredCourses"];
                           
                            $reg_courses=Yii::$app->request->post()["course_id"];
                           
                            foreach ($reg_courses as $course){
                                $model = new RegisteredCourses();
                                $fac = Courses::find()->where(['course_id' => $course])->all();
                                $model->fac_id=$fac[0]['fac_id'];
                                $model->fac_id=$fac[0]['dept_id'];
                              
                                $model->user_id=Yii::$app->user->identity->id;
                                $model->course_id=$course;
                                echo "<pre>";
                                var_dump($model);
                                echo "</pre>";


                                $model->save(false);
                            };die();
                            $modelCheck = RegisteredCourses::find()->where(['user_id'=>$id])->all();
                            $searchModel = new RegisteredCoursesSearch();
                            $dataProvider = $searchModel->search($modelCheck);

                            $message = 'Pending';

                            return $this->render('welcome', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                                'message' => $message,
                            ]);
                                

                 } else {
                        return $this->render('create', [
                            'model' => $model,
                            
                          ]);
                    }
            

               
             
          }
       else{
             throw new ForbiddenHttpException;
         } 
   
    }

    /**
     * Updates an existing RegisteredCourses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('admin')){
             $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->reg_id]);
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
     * Deletes an existing RegisteredCourses model.
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
     * Finds the RegisteredCourses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegisteredCourses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegisteredCourses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
