<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\NavisionJobGroups;

/**
 * NavisionJobGroupsSearch represents the model behind the search form of `common\models\NavisionJobGroups`.
 */
class NavisionJobGroupsSearch extends NavisionJobGroups
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timestamp', 'Scale', 'Grade Identifier'], 'safe'],
            [['Minimum Pointer', 'Maximum Pointer', 'House Allowance', 'Commuter Allowance', 'In Patient Limit', 'Out Patient Limit', 'Annual Increaments', 'Extreneous Allowance', 'Leave Allowance'], 'number'],
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
        $query = NavisionJobGroups::find();

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
            'timestamp' => $this->timestamp,
            'Minimum Pointer' => $this->{'Minimum Pointer'},
            'Maximum Pointer' => $this->{'Maximum Pointer'},
            'House Allowance' => $this->{'House Allowance'},
            'Commuter Allowance' => $this->{'Commuter Allowance'},
            'In Patient Limit' => $this->{'In Patient Limit'},
            'Out Patient Limit' => $this->{'Out Patient Limit'},
            'Annual Increaments' => $this->{'Annual Increaments'},
            'Extreneous Allowance' => $this->{'Extreneous Allowance'},
            'Leave Allowance' => $this->{'Leave Allowance'},
        ]);

        $query->andFilterWhere(['like', 'Scale', $this->Scale])
            ->andFilterWhere(['like', 'Grade Identifier', $this->{'Grade Identifier'}]);

        return $dataProvider;
    }
}
