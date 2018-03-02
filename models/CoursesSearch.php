<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Courses;

/**
 * CoursesSearch represents the model behind the search form about `app\models\Courses`.
 */
class CoursesSearch extends Courses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'fac_id', 'dept_id'], 'integer'],
            [['course_name', 'course_code', 'update_at', 'created_at'], 'safe'],
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
        $query = Courses::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'course_id' => $this->course_id,
            'fac_id' => $this->fac_id,
            'dept_id' => $this->dept_id,
            'update_at' => $this->update_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'course_name', $this->course_name])
            ->andFilterWhere(['like', 'course_code', $this->course_code]);

        return $dataProvider;
    }
}
