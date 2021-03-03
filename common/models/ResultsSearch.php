<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Results;

/**
 * ResultsSearch represents the model behind the search form of `common\models\Results`.
 */
class ResultsSearch extends Results
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'EvaluationId', 'AppraisalPeriodId', 'EvaluationType', 'Rating', 'WorkPlanScore', 'SoftSkillsScore', 'PerformanceSkillsScore', 'CoreValuesScore', 'Excellent'], 'integer'],
            [['EmployeeNo', 'EmployeeDepartment', 'JobLevel', 'Designation', 'Supervisor', 'SupervisorDesignation'], 'safe'],
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
        $query = Results::find();

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
            'EvaluationId' => $this->EvaluationId,
            'AppraisalPeriodId' => $this->AppraisalPeriodId,
            'EvaluationType' => $this->EvaluationType,
            'Rating' => $this->Rating,
            'WorkPlanScore' => $this->WorkPlanScore,
            'SoftSkillsScore' => $this->SoftSkillsScore,
            'PerformanceSkillsScore' => $this->PerformanceSkillsScore,
            'CoreValuesScore' => $this->CoreValuesScore,
            'Excellent' => $this->Excellent,
        ]);

        $query->andFilterWhere(['like', 'EmployeeNo', $this->EmployeeNo])
            ->andFilterWhere(['like', 'EmployeeDepartment', $this->EmployeeDepartment])
            ->andFilterWhere(['like', 'JobLevel', $this->JobLevel])
            ->andFilterWhere(['like', 'Designation', $this->Designation])
            ->andFilterWhere(['like', 'Supervisor', $this->Supervisor])
            ->andFilterWhere(['like', 'SupervisorDesignation', $this->SupervisorDesignation]);

        return $dataProvider;
    }
}
