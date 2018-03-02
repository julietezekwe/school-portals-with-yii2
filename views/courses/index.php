<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\UsersController;
use app\models\LoginForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>

 <div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Courses', ['value'=> Url::to('/courses/create'), 'class' => 'btn btn-success', 'id'=>'modalButton',]) ?>
    </p>
    <?php 
       Modal::begin([
        'header'=> '<h3>Courses</h3>',
        'id'=> 'modal',
        'size'=> 'modal-lg',


       ]);
       echo "<div id='modalContent'></div>";
       Modal::end();

     ?>
   <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fac.fac_name',
            'dept.dept_name',
            'course_name',
            'course_code',
            // 'update_at',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

 
