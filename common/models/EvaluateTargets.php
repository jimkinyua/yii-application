<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "EvaluateTargets".
 *
 * @property int $Id
 * @property int $WorkPlanId
 * @property int|null $SelfRating
 * @property int|null $SupervisorRating
 * @property int|null $AgreedScore
 * @property string|null $SupervisorRemarks
 * @property int $TargetTypeId
 * @property string|null $Achievements
 * @property int $TargetId
 * @property int $EvaluationId
 * @property string $TargetDescription
 *
 * @property IndividualWorkPlan $workPlan
 * @property TargetTypes $targetType
 * @property Evaluations $evaluation
 */
class EvaluateTargets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $TargetImprovementAreas;
    public static function tableName()
    {
        return 'EvaluateTargets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['WorkPlanId', 'TargetTypeId', 'TargetId', 'EvaluationId', 'TargetDescription'], 'required'],
            [['WorkPlanId', 'SelfRating', 'SupervisorRating', 'AgreedScore', 'TargetTypeId', 'TargetId', 'EvaluationId'], 'integer'],
            [['SupervisorRemarks', 'Achievements', 'TargetDescription'], 'string'],
            [['WorkPlanId'], 'exist', 'skipOnError' => true, 'targetClass' => IndividualWorkPlan::className(), 'targetAttribute' => ['WorkPlanId' => 'IndividualWorkPlanId']],
            [['TargetTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => TargetTypes::className(), 'targetAttribute' => ['TargetTypeId' => 'TargetTypeId']],
            [['EvaluationId'], 'exist', 'skipOnError' => true, 'targetClass' => Evaluations::className(), 'targetAttribute' => ['EvaluationId' => 'EvaluationId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'WorkPlanId' => 'Work Plan ID',
            'SelfRating' => 'Self Rating',
            'SupervisorRating' => 'Supervisor Rating',
            'AgreedScore' => 'Agreed Score',
            'SupervisorRemarks' => 'Supervisor Remarks',
            'TargetTypeId' => 'Target Type ID',
            'Achievements' => 'Achievements',
            'TargetId' => 'Target ID',
            'EvaluationId' => 'Evaluation ID',
            'TargetDescription' => 'Target Description',
        ];
    }

    /**
     * Gets query for [[WorkPlan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkPlan()
    {
        return $this->hasOne(IndividualWorkPlan::className(), ['IndividualWorkPlanId' => 'WorkPlanId']);
    }

    /**
     * Gets query for [[TargetType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTargetType()
    {
        return $this->hasOne(TargetTypes::className(), ['TargetTypeId' => 'TargetTypeId']);
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
     * Gets query for [[TargetImprovementAreas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTargetImprovementAreas()
    {
        return $this->hasMany(TargetImprovementAreas::className(), ['TargetId' => 'Id']);
    }
}
