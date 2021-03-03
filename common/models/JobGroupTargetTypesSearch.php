<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\JobGroupTargetTypes;

/**
 * JobGroupTargetTypesSearch represents the model behind the search form of `common\models\JobGroupTargetTypes`.
 */
class JobGroupTargetTypesSearch extends JobGroupTargetTypes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'JobGroupId', 'TargetTypeId'], 'integer'],
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
        $query = JobGroupTargetTypes::find();

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
            'Id' => $this->Id,
            'JobGroupId' => $this->JobGroupId,
            'TargetTypeId' => $this->TargetTypeId,
        ]);

        return $dataProvider;
    }
}
