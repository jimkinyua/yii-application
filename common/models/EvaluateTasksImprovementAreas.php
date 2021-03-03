<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "EvaluateTasksImprovementAreas".
 *
 * @property int $Id
 * @property int $EvaluationId
 * @property string $Description
 * @property int|null $SelfRating
 * @property int|null $SupervisorRating
 * @property int|null $AgreedScore
 * @property string|null $SupervisorRemarks
 * @property string|null $Achievements
 * @property string $Addressed
 * @property int $TargetImprovementAreaId
 *
 * @property Evaluations $evaluation
 * @property AreasOfImprovement $targetImprovementArea
 */
class EvaluateTasksImprovementAreas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'EvaluateTasksImprovementAreas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['EvaluationId', 'Description', 'Addressed', 'TaskmprovementAreaId'], 'required'],
            [['EvaluationId', 'SelfRating', 'SupervisorRating', 'Addressed', 'AgreedScore', 'TaskmprovementAreaId'], 'integer'],
            [['Description', 'SupervisorRemarks', 'Achievements'], 'string'],
            [['EvaluationId'], 'exist', 'skipOnError' => true, 'targetClass' => Evaluations::className(), 'targetAttribute' => ['EvaluationId' => 'EvaluationId']],
            [['TaskmprovementAreaId'], 'exist', 'skipOnError' => true, 'targetClass' => AreasOfImprovement::className(), 'targetAttribute' => ['TaskmprovementAreaId' => 'AreaImprovementId']],
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
            'TaskmprovementAreaId' => 'Task Improvement Area ID',
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
        return $this->hasOne(AreasOfImprovement::className(), ['AreaImprovementId' => 'TaskmprovementAreaId']);
    }
}
