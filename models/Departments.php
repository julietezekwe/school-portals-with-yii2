<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property integer $dept_id
 * @property integer $fac_id
 * @property string $dept_name
 * @property string $dept_code
 * @property string $update_at
 * @property string $created_at
 *
 * @property Courses[] $courses
 * @property Faculty $fac
 * @property Users[] $users
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fac_id', 'dept_name', 'dept_code'], 'required'],
            [['fac_id'], 'integer'],
            [['update_at', 'created_at'], 'safe'],
            [['dept_name'], 'string', 'max' => 100],
            [['dept_code'], 'string', 'max' => 3],
            [['fac_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['fac_id' => 'fac_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dept_id' => 'Dept ID',
            'fac_id' => 'Fac ID',
            'dept_name' => 'Dept Name',
            'dept_code' => 'Dept Code',
            'update_at' => 'Update At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Courses::className(), ['dept_id' => 'dept_id']);
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
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['dept_id' => 'dept_id']);
    }

    
}
