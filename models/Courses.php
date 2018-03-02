<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property integer $course_id
 * @property integer $fac_id
 * @property integer $dept_id
 * @property string $course_name
 * @property string $course_code
 * @property string $update_at
 * @property string $created_at
 *
 * @property Faculty $fac
 * @property Departments $dept
 * @property RegisteredCourses[] $registeredCourses
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fac_id', 'dept_id', 'course_name', 'course_code'], 'required'],
            [['fac_id', 'dept_id'], 'integer'],
            [['update_at', 'created_at'], 'safe'],
            [['course_name'], 'string', 'max' => 100],
            [['course_code'], 'string', 'max' => 3],
            [['fac_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['fac_id' => 'fac_id']],
            [['dept_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['dept_id' => 'dept_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course ID',
            'fac_id' => 'Fac ID',
            'dept_id' => 'Dept ID',
            'course_name' => 'Course Name',
            'course_code' => 'Course Code',
            'update_at' => 'Update At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFac()
    {
        return $this->hasOne(Faculty::className(), ['fac_id' => 'fac_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDept()
    {
        return $this->hasOne(Departments::className(), ['dept_id' => 'dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisteredCourses()
    {
        return $this->hasMany(RegisteredCourses::className(), ['course_id' => 'course_id']);
    }

    
}
