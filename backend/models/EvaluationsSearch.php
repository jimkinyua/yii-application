<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Evaluations;

/**
 * EvaluationsSearch represents the model behind the search form of `common\models\Evaluations`.
 */
class EvaluationsSearch extends Evaluations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['EvaluationId', 'WorkPlanId', 'AppraisalPeriodid', 'Status', 'Contested', 'EvaluationTypeId'], 'integer'],
            [['EmpNo', 'Code', 'ImmediateSupervisor'], 'safe'],
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
        $query = Evaluations::find();

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
            'EvaluationId' => $this->EvaluationId,
            'WorkPlanId' => $this->WorkPlanId,
            'AppraisalPeriodid' => $this->AppraisalPeriodid,
            'Status' => $this->Status,
            'Contested' => $this->Contested,
            'EvaluationTypeId' => $this->EvaluationTypeId,
        ]);

        $query->andFilterWhere(['like', 'EmpNo', $this->EmpNo])
            ->andFilterWhere(['like', 'Code', $this->Code])
            ->andFilterWhere(['like', 'ImmediateSupervisor', $this->ImmediateSupervisor]);

        return $dataProvider;
    }
}
