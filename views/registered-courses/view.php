<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RegisteredCourses */

$this->title = $model->reg_id;
$this->params['breadcrumbs'][] = ['label' => 'Registered Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registered-courses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->reg_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->reg_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'reg_id',
            'user_id',
            'fac_id',
            'dept_id',
            'course_id',
            'updated_at',
            'created_at',
            'status',
        ],
    ]) ?>

</div>
