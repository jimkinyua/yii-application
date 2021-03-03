<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\KeyResultAreas;

/**
 * KeyResultAreasSearch represents the model behind the search form of `common\models\KeyResultAreas`.
 */
class KeyResultAreasSearch extends KeyResultAreas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KeyResultAreaId', 'TaskId', 'EvaluationId', 'SelfRating', 'SupervisorRating', 'Ontime', 'AgreedScore', 'IndividualObjectiveId', 'WorkPlanWeight'], 'integer'],
            [['AppraiseeRemarks', 'SupervisorRemarks', 'Evidence_File', 'FaultReason', 'Achievements', 'TaskDescription'], 'safe'],
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
        $query = KeyResultAreas::find();

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
            'KeyResultAreaId' => $this->KeyResultAreaId,
            'TaskId' => $this->TaskId,
            'EvaluationId' => $this->EvaluationId,
            'SelfRating' => $this->SelfRating,
            'SupervisorRating' => $this->SupervisorRating,
            'Ontime' => $this->Ontime,
            'AgreedScore' => $this->AgreedScore,
            'IndividualObjectiveId' => $this->IndividualObjectiveId,
            'WorkPlanWeight' => $this->WorkPlanWeight,
        ]);

        $query->andFilterWhere(['like', 'AppraiseeRemarks', $this->AppraiseeRemarks])
            ->andFilterWhere(['like', 'SupervisorRemarks', $this->SupervisorRemarks])
            ->andFilterWhere(['like', 'Evidence_File', $this->Evidence_File])
            ->andFilterWhere(['like', 'FaultReason', $this->FaultReason])
            ->andFilterWhere(['like', 'Achievements', $this->Achievements])
            ->andFilterWhere(['like', 'TaskDescription', $this->TaskDescription]);

        return $dataProvider;
    }
}
