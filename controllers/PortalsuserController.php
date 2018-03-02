<?php

namespace app\controllers;

use Yii;
use app\models\Portalsuser;
use app\models\PortalsuserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\AuthItem;
use app\models\RegisteredCourses;
use app\models\AuthAssignment;
use yii\helpers\ArrayHelper;
/**
 * PortalsuserController implements the CRUD actions for Portalsuser model.
 */
class PortalsuserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin()
    {
    

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['../registered-courses/welcome']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->render('../registered-courses/welcome');
    }

    /**
     * Lists all Portalsuser models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('admin')){
                $model;
                 if (Yii::$app->user->isGuest) {
                     return $this->redirect(['login']);
                 
                 }
                 else{
                 $searchModel = new PortalsuserSearch();
                 $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
     
                 return $this->render('index', [
                     'searchModel' => $searchModel,
                     'dataProvider' => $dataProvider,
                 ]);
             }
         }
      else{
            
           throw new ForbiddenHttpException;
         }
    }

    public function actionWelcome()
    {
      
     
        return $this->render('welcome');
    
    }



    /**
     * Displays a single Portalsuser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('admin')){
            return $this->render('view', [
            'model' => $this->findModel($id),
        ]);}
      else{
            
           throw new ForbiddenHttpException;
         }
    }

    /**
     * Creates a new Portalsuser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      if (Yii::$app->user->can('admin')){
                $model = new Portalsuser();
                $authItems = AuthItem::find()->all();
                $authItems = ArrayHelper::map($authItems, 'name', 'name');

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $authAssignment = new AuthAssignment();
                $permissions = Yii::$app->request->post()['Portalsuser']['permission'];
                foreach ($permissions as $permission) {
                    $authAssignment->item_name = $permission;
                    $authAssignment->user_id = $model->id;
                    $authAssignment->save();  
                }
               
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                    'authItems' => $authItems,
                ]);
            }
      }
     else{
            
           throw new ForbiddenHttpException;
         }
    }

    /**
     * Updates an existing Portalsuser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('admin')){
                $model = $this->findModel($id);
                

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id] );
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
     * Deletes an existing Portalsuser model.
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
     * Finds the Portalsuser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Portalsuser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Portalsuser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
