<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Faculty;
use app\models\Departments;
use app\models\Courses;
/* @var $this yii\web\View */
/* @var $model app\models\RegisteredCourses */

$this->title = 'Update Registered Courses: ' . $model->reg_id;
$this->params['breadcrumbs'][] = ['label' => 'Registered Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->reg_id, 'url' => ['view', 'id' => $model->reg_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registered-courses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="courses-form">
       
       <?php $form = ActiveForm::begin(); ?>
       <?= $form->field($model, 'status')->dropDownList(['pending'=> 'Pending', 'approved' => 'Approved']); ?>
       

       

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>
