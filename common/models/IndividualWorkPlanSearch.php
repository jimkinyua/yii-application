<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\IndividualWorkPlan;

/**
 * IndividualWorkPlanSearch represents the model behind the search form of `common\models\IndividualWorkPlan`.
 */
class IndividualWorkPlanSearch extends IndividualWorkPlan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IndividualWorkPlanId', 'DeptWorkPlanId'], 'integer'],
            [['Code', 'Description', 'EmpNo'], 'safe'],
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
        $query = IndividualWorkPlan::find();

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
            'IndividualWorkPlanId' => $this->IndividualWorkPlanId,
            'DeptWorkPlanId' => $this->DeptWorkPlanId,
        ]);

        $query->andFilterWhere(['like', 'Code', $this->Code])
            ->andFilterWhere(['like', 'Description', $this->Description])
            ->andFilterWhere(['like', 'EmpNo', $this->EmpNo]);

        return $dataProvider;
    }
}
