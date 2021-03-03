<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TargetImprovementAreas;

/**
 * TargetImprovementAreasSearch represents the model behind the search form of `common\models\TargetImprovementAreas`.
 */
class TargetImprovementAreasSearch extends TargetImprovementAreas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'TargetId', 'AppraisalPeriodid', 'AppraiseeScore', 'SupervisorScore', 'Addressed'], 'integer'],
            [['Description', 'EmpNo'], 'safe'],
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
        $query = TargetImprovementAreas::find();

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
            'TargetId' => $this->TargetId,
            'AppraisalPeriodid' => $this->AppraisalPeriodid,
            'AppraiseeScore' => $this->AppraiseeScore,
            'SupervisorScore' => $this->SupervisorScore,
            'Addressed' => $this->Addressed,
        ]);

        $query->andFilterWhere(['like', 'Description', $this->Description])
            ->andFilterWhere(['like', 'EmpNo', $this->EmpNo]);

        return $dataProvider;
    }
}
