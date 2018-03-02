<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RegisteredCourses;

/**
 * RegisteredCoursesSearch represents the model behind the search form about `app\models\RegisteredCourses`.
 */
class RegisteredCoursesSearch extends RegisteredCourses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_id', 'user_id', 'fac_id', 'dept_id', 'course_id'], 'integer'],
            [['updated_at', 'created_at', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if (yii::$app->user->can('admin')) {
            # code...
        $query = RegisteredCourses::find()->select('user_id')->distinct();}
        
        else if (yii::$app->user->can('register-course'))
            {$query = RegisteredCourses::find();
            }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $user_id = Yii::$app->user->identity->id;

         $status = 'pending';
        // grid filtering conditions
        if (yii::$app->user->can('admin')) {
        $query->andFilterWhere([         
            'reg_id' => $this->reg_id,
            'user_id' => $this->user_id,
            'status' => $status,
            'fac_id' => $this->fac_id,
            'dept_id' => $this->dept_id,
            'course_id' => $this->course_id,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;}

        else if (yii::$app->user->can('register-course')){
            $query->andFilterWhere([            
            'reg_id' => $this->reg_id,
            'user_id' => $user_id,
            'fac_id' => $this->fac_id,
            'dept_id' => $this->dept_id,
            'course_id' => $this->course_id,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;

        }
    }
}
