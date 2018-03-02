<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'dept_id') ?>

    <?= $form->field($model, 'fac_id') ?>

    <?= $form->field($model, 'dept_name') ?>

    <?= $form->field($model, 'dept_code') ?>

    <?= $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
