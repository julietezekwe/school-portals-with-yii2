<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Faculty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faculty-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fac_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fac_code')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
