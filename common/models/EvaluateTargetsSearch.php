<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EvaluateTargets;

/**
 * EvaluateTargetsSearch represents the model behind the search form of `common\models\EvaluateTargets`.
 */
class EvaluateTargetsSearch extends EvaluateTargets
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'WorkPlanId', 'SelfRating', 'SupervisorRating', 'AgreedScore', 'TargetTypeId', 'TargetId', 'EvaluationId'], 'integer'],
            [['SupervisorRemarks', 'Achievements', 'TargetDescription'], 'safe'],
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
        $query = EvaluateTargets::find();

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
            'WorkPlanId' => $this->WorkPlanId,
            'SelfRating' => $this->SelfRating,
            'SupervisorRating' => $this->SupervisorRating,
            'AgreedScore' => $this->AgreedScore,
            'TargetTypeId' => $this->TargetTypeId,
            'TargetId' => $this->TargetId,
            'EvaluationId' => $this->EvaluationId,
        ]);

        $query->andFilterWhere(['like', 'SupervisorRemarks', $this->SupervisorRemarks])
            ->andFilterWhere(['like', 'Achievements', $this->Achievements])
            ->andFilterWhere(['like', 'TargetDescription', $this->TargetDescription]);

        return $dataProvider;
    }
}
