<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registered_courses".
 *
 * @property integer $reg_id
 * @property integer $user_id
 * @property integer $fac_id
 * @property integer $dept_id
 * @property integer $course_id
 * @property string $updated_at
 * @property string $created_at
 * @property string $status
 *
 * @property Portalsuser $user
 * @property Faculty $fac
 * @property Departments $dept
 * @property Courses $course
 * @property Portalsuser $user0
 */
class RegisteredCourses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registered_courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['fac_id', 'dept_id', 'course_id','user_id'], 'required'],
            [['user_id', 'fac_id', 'dept_id', 'course_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['status'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Portalsuser::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['fac_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['fac_id' => 'fac_id']],
            [['dept_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['dept_id' => 'dept_id']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['course_id' => 'course_id']],
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reg_id' => 'Reg ID',
            'user_id' => 'User ID',
            'fac_id' => 'Fac ID',
            'dept_id' => 'Dept ID',
            'course_id' => 'Course ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalsuser()
    {
        return $this->hasOne(Portalsuser::className(), ['id' => 'user_id']);
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
    public function getCourse()
    {
        return $this->hasOne(Courses::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(Portalsuser::className(), ['id' => 'user_id']);
    }
}
