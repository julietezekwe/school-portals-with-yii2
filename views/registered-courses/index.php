<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegisteredCoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registered Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registered-courses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 

   

   ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],

            // 'reg_id',
            'portalsuser.id',
            'portalsuser.username',
            // 'fac.fac_name',
            // 'dept.dept_name',
            // 'course.course_name',
            // 'status',
            // 'updated_at',
            // 'created_at',
            // 'status',
            [
            'class' => 'yii\grid\ActionColumn',
            'template' => ' {myButton}',  // the default buttons + your custom button
            'buttons' => [
                'myButton' => function($url, $key, $data) {     // render your custom button
                    return Html::a("review", ["review?id=$data[user_id]"] );
                }
            ]
        ]
        ],
    ]); ?>
 
</div>
