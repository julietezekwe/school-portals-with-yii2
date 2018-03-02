<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PortalsuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Portalsusers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portalsuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create User', ['value'=> Url::to('/portalsuser/create'), 'class' => 'btn btn-success', 'id'=>'modalButton',]) ?>
    </p>

    <?php 
       Modal::begin([
        'header'=> '<h3>Users</h3>',
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

            'id',
            'firstname',
            'lastname',
            'username',
            'password',
            // 'authKey',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
     <?php Pjax::end(); ?>
</div>
