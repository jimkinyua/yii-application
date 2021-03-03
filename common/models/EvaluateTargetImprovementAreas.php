<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "EvaluateTargetImprovementAreas".
 *
 * @property int $Id
 * @property int $EvaluationId
 * @property string $Description
 * @property int|null $SelfRating
 * @property int|null $SupervisorRating
 * @property int|null $AgreedScore
 * @property string|null $SupervisorRemarks
 * @property string $Achievements
 * @property int $Addressed
 * @property int $TargetImprovementAreaId
 *
 * @property Evaluations $evaluation
 * @property TargetImprovementAreas $targetImprovementArea
 */
class EvaluateTargetImprovementAreas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'EvaluateTargetImprovementAreas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['EvaluationId', 'Description', 'Addressed', 'TargetImprovementAreaId'], 'required'],
            [['EvaluationId', 'SelfRating', 'SupervisorRating', 'AgreedScore', 'Addressed', 'TargetImprovementAreaId'], 'integer'],
            [['Description', 'SupervisorRemarks', 'Achievements'], 'string'],
            [['EvaluationId'], 'exist', 'skipOnError' => true, 'targetClass' => Evaluations::className(), 'targetAttribute' => ['EvaluationId' => 'EvaluationId']],
            [['TargetImprovementAreaId'], 'exist', 'skipOnError' => true, 'targetClass' => TargetImprovementAreas::className(), 'targetAttribute' => ['TargetImprovementAreaId' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'EvaluationId' => 'Evaluation ID',
            'Description' => 'Description',
            'SelfRating' => 'Self Rating',
            'SupervisorRating' => 'Supervisor Rating',
            'AgreedScore' => 'Agreed Score',
            'SupervisorRemarks' => 'Supervisor Remarks',
            'Achievements' => 'Achievements',
            'Addressed' => 'Addressed',
            'TargetImprovementAreaId' => 'Target Improvement Area ID',
        ];
    }

    /**
     * Gets query for [[Evaluation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluation()
    {
        return $this->hasOne(Evaluations::className(), ['EvaluationId' => 'EvaluationId']);
    }

    /**
     * Gets query for [[TargetImprovementArea]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTargetImprovementArea()
    {
        return $this->hasOne(TargetImprovementAreas::className(), ['Id' => 'TargetImprovementAreaId']);
    }
}
