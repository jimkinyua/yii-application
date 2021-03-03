<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "KeyResultAreas".
 *
 * @property int $KeyResultAreaId
 * @property int $TaskId
 * @property int $EvaluationId
 * @property string|null $AppraiseeRemarks
 * @property int|null $SelfRating
 * @property int|null $SupervisorRating
 * @property string|null $SupervisorRemarks
 * @property string|null $Evidence_File
 * @property int|null $Ontime
 * @property string|null $FaultReason
 * @property int|null $AgreedScore
 * @property string|null $Achievements
 * @property int $IndividualObjectiveId
 * @property resource $TaskDescription
 * @property int $WorkPlanWeight
 *
 * @property Evaluations $evaluation
 */
class KeyResultAreas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $files;
    public static function tableName()
    {
        return 'KeyResultAreas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TaskId', 'EvaluationId', 'IndividualObjectiveId', 'TaskDescription', 'WorkPlanWeight'], 'required'],
            [['TaskId', 'EvaluationId', 'SelfRating', 'SupervisorRating', 'Ontime', 'AgreedScore', 'IndividualObjectiveId', 'WorkPlanWeight'], 'integer'],
            [['AppraiseeRemarks', 'SupervisorRemarks', 'FaultReason', 'ImprovementAreas','Achievements', 'TaskDescription'], 'string'],
            [['EvaluationId'], 'exist', 'skipOnError' => true, 'targetClass' => Evaluations::className(), 'targetAttribute' => ['EvaluationId' => 'EvaluationId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KeyResultAreaId' => 'Key Result Area ID',
            'TaskId' => 'Task ID',
            'EvaluationId' => 'Evaluation ID',
            'AppraiseeRemarks' => 'Appraisee Remarks',
            'SelfRating' => 'Self Rating',
            'SupervisorRating' => 'Supervisor Rating',
            'SupervisorRemarks' => 'Supervisor Remarks',
            'Ontime' => 'Ontime',
            'FaultReason' => 'Fault Reason',
            'AgreedScore' => 'Agreed Score',
            'Achievements' => 'Achievements',
            'IndividualObjectiveId' => 'Individual Objective ID',
            'TaskDescription' => 'Task Description',
            'WorkPlanWeight' => 'Work Plan Weight',
            'ImprovementAreas'=> 'Improvement Areas'
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

    public function getKeyResultAreaAttachements()
    {
        return $this->hasMany(KeyResultAreaAttachements::className(), ['KeyResultId' => 'KeyResultAreaId']);
    }
    
       /**
     * Gets query for [[AreasOfImprovements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAreasOfImprovements()
    {
        return $this->hasMany(AreasOfImprovement::className(), ['KeyResultId' => 'KeyResultAreaId']);
    }
}
