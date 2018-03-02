<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="departments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
      
    <p>
        <?= Html::button('Create Departments', ['value'=> Url::to('/departments/create'), 'class' => 'btn btn-success', 'id'=>'modalButton',]) ?>
    </p>

    <?php 
       Modal::begin([
        'header'=> '<h3>Departments</h3>',
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

            // 'dept_id',
            'fac.fac_name',
            'dept_name',
            'dept_code',
            // 'update_at',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

     <?php Pjax::end(); ?>
</div>


