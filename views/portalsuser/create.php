<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Portalsuser */

$this->title = 'Create Portalsuser';
$this->params['breadcrumbs'][] = ['label' => 'Portalsusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portalsuser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'authItems' => $authItems,
        'id'=> $id,
        
    ]) ?>

</div>
