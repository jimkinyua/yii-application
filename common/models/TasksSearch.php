<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tasks;

/**
 * TasksSearch represents the model behind the search form of `common\models\Tasks`.
 */
class TasksSearch extends Tasks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TaskId', 'TaskDescription', 'IndividualObjectiveId', 'weight'], 'integer'],
            [['ExpectedOutPut', 'ResourcesRequired', 'KPI', 'Timeline'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Tasks::find();

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
            'TaskId' => $this->TaskId,
            'TaskDescription' => $this->TaskDescription,
            'IndividualObjectiveId' => $this->IndividualObjectiveId,
            'weight' => $this->weight,
            'Timeline' => $this->Timeline,
        ]);

        $query->andFilterWhere(['like', 'ExpectedOutPut', $this->ExpectedOutPut])
            ->andFilterWhere(['like', 'ResourcesRequired', $this->ResourcesRequired])
            ->andFilterWhere(['like', 'KPI', $this->KPI]);

        return $dataProvider;
    }
}
