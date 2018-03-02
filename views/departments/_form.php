<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Faculty;

/* @var $this yii\web\View */
/* @var $model app\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <?= $form->field($model, 'fac_id')->dropDownList(

        ArrayHelper::map(Faculty::find()->all(), 'fac_id','fac_name'),

        ['prompt'=>'Select Faculty']) ?>

    <?= $form->field($model, 'dept_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dept_code')->textInput(['maxlength' => true]) ?>

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
