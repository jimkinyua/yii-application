<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AppraisalPeriods;

/**
 * AppraisalPeriodsSearch represents the model behind the search form of `common\models\AppraisalPeriods`.
 */
class AppraisalPeriodsSearch extends AppraisalPeriods
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AppraisalPeriodId'], 'integer'],
            [['Description', 'StartDate', 'EndDate'], 'safe'],
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
        $query = AppraisalPeriods::find();

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
            'AppraisalPeriodId' => $this->AppraisalPeriodId,
            'StartDate' => $this->StartDate,
            'EndDate' => $this->EndDate,
        ]);

        $query->andFilterWhere(['like', 'Description', $this->Description]);

        return $dataProvider;
    }
}
