<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Faculty;
use app\models\Departments;


/* @var $this yii\web\View */
/* @var $model app\models\Courses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="courses-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'fac_id')->dropDownList(

           ArrayHelper::map(Faculty::find()->all(), 'fac_id','fac_name'),

           [ 
             'prompt'=>'Select Faculty',
             'onchange'=>'
             $.post("'.Yii::$app->urlManager->createUrl('departments/lists?id=').'"+$(this).val(), function( data ) {$( "#courses-dept_id") .html( data )
         });'
           ]); ?>
        

     <?= $form->field($model, 'dept_id')->dropDownList(

         // ArrayHelper::map(Departments::find()->all(), 'dept_id','dept_name'),

         ['prompt'=>'Select Department',]) ?>   

    <?= $form->field($model, 'course_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_code')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
