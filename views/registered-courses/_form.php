   <?php

   use yii\helpers\Html;
   use yii\widgets\ActiveForm;
   use yii\helpers\ArrayHelper;
   use app\models\Faculty;
   use app\models\Departments;
   use app\models\Courses;


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
             $.post("'.Yii::$app->urlManager->createUrl('departments/lists?id=').'"+$(this).val(), function( data ) {$( "#registeredcourses-dept_id") .html( data )
         });'
           ]); ?>
           
        <?= $form->field($model, 'dept_id')->dropDownList(

            ArrayHelper::map(Departments::find()->all(), 'dept_id','dept_name'),
           [ 
             'prompt'=>'Select Select Departments',
             'onchange'=>'
             $.post("'.Yii::$app->urlManager->createUrl('courses/lists?id=').'"+$(this).val(), function( data ) {$( "#registeredcourses-course_id") .append( data )
         });'
           ]); ?> 

         <?= $form->field($model, 'course_id[]')->checkboxList(

             // ArrayHelper::map(Courses::find()->all(), 'course_id','course_name'),

             ['prompt'=>'Select Course']) ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
