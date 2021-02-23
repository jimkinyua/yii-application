<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StrategicObjectives;

/**
 * StrategicObjectivesSearch represents the model behind the search form of `common\models\StrategicObjectives`.
 */
class StrategicObjectivesSearch extends StrategicObjectives
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StrategicObjectiveId', 'StrategicPlanId'], 'integer'],
            [['ObjectiveName'], 'safe'],
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
        $query = StrategicObjectives::find();

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
            'StrategicObjectiveId' => $this->StrategicObjectiveId,
            'StrategicPlanId' => $this->StrategicPlanId,
        ]);

        $query->andFilterWhere(['like', 'ObjectiveName', $this->ObjectiveName]);

        return $dataProvider;
    }
}
