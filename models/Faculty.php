<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property integer $fac_id
 * @property string $fac_name
 * @property string $fac_code
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Courses[] $courses
 * @property Departments[] $departments
 * @property Users[] $users
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fac_name', 'fac_code'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['fac_name'], 'string', 'max' => 100],
            [['fac_code'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fac_id' => 'Fac ID',
            'fac_name' => 'Fac Name',
            'fac_code' => 'Fac Code',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Courses::className(), ['fac_id' => 'fac_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['fac_id' => 'fac_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['fac_id' => 'fac_id']);
    }

    public static function dropDown(){
        static $dropDown;
        if ($dropDown===null) {
            $models = static::find()->all();
            foreach ($models as $model) {
                $dropDown[$model->fac_id] = $model->fac_name;
            }
            # code...
        }

        return $dropDown;
    }
}
