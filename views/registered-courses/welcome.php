<?php

use yii\helpers\Html;
use app\models\RegisteredCourses;
use app\models\Courses;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Portalsuser */

?>
<?php  if(yii::$app->user->isGuest){//check if user is guest
               $this->title = 'welcome';
               ?>
               <div class="site-index">

                   <div class="jumbotron">
                       <h1>Welcome!</h1>

                       <p class="lead">This is the school course registration portal.</p>

                       <p><a class="btn btn-lg btn-success" href="login">Login with your username and password to register your courses</a></p>
                   </div>

                   <div class="body-content">

                       <div class="row">
                           <div class="col-lg-4">
                               <h2>Heading</h2>

                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                   fugiat nulla pariatur.</p>

                               <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                           </div>
                           <div class="col-lg-4">
                               <h2>Heading</h2>

                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                   fugiat nulla pariatur.</p>

                               <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                           </div>
                           <div class="col-lg-4">
                               <h2>Heading</h2>

                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                   ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                   fugiat nulla pariatur.</p>

                               <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                           </div>
                       </div>

                   </div>
               </div>
<?php }

else if (Yii::$app->user->can('admin')) {//check if user is admin
            	$username = Yii::$app->user->identity->username;
            	$id= Yii::$app->user->identity->id;
                ?>
                <div class="jumbotron">
                        <?php
                    	echo '<h3>Welcome to the course registration portal <strong>'. $username. '</strong> Manage your accounts here</h3>';
                    	?>

                    	<p>
                    	        <?= Html::a('Manage Registered courses', ['index'], ['class' => 'btn btn-success', 'id']) ?>

                    	 </p>
                    	 <p>
                    	        <?= Html::a('Manage Depts', ['../departments'], ['class' => 'btn btn-success']) ?>
                    	 </p>
                    	 <p>
                    	        <?= Html::a('Manage Faculty', ['../faculty'], ['class' => 'btn btn-success']) ?>
                    	 </p>

                    	 <p>
                    	        <?= Html::a('Manage User', ['../portalsuser'], ['class' => 'btn btn-success']) ?>
                    	 </p>

                    	 <p>
                    	        <?= Html::a('Manage Courses', ['../courses'], ['class' => 'btn btn-success']) ?>
                    	 </p>
                       </div>
<?php }
    //getting registered courses for display              
else if (isset($dataProvider) && isset($searchModel)) {
    echo $message;
      # code...
     ?>
     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class'=> 'yii\grid\CheckBoxColumn'],
            ['class' => 'yii\grid\SerialColumn'],

            // 'reg_id',
            'portalsuser.id',
            'portalsuser.username',
            'fac.fac_name',
            'dept.dept_name',
            'course.course_name',
            'status',
            // 'updated_at',
            // 'created_at',
            // 'status',

           
        ],
    ]); ?>
    
    
<?php } 


else{//user before registration of courses
    $username = Yii::$app->user->identity->username;
    $id= Yii::$app->user->identity->id; ?>

    <div class="jumbotron">

        <?php echo '<h3>Welcome to the course registration portal <strong>'. $username. '</strong> Please Register your courses</h3><br><aside>NB: You can only register in a semester.</aside><br>';?>
        <p>

            <?= Html::a('Reistered/View Courses', ['../registered-courses/create', 'id' => $id], ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
<?php 
} ?>

<div class="portalsuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    

</div>
