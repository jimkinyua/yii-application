<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Tasks".
 *
 * @property int $TaskId
 * @property int $TaskDescription
 * @property int $IndividualObjectiveId
 * @property string $ExpectedOutPut
 * @property string $ResourcesRequired
 * @property string $KPI
 * @property int $weight
 * @property string $Timeline
 *
 * @property IndividualObjectives $individualObjective
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TaskDescription', 'IndividualObjectiveId', 'ExpectedOutPut', 'ResourcesRequired', 'KPI', 'weight', 'Timeline'], 'required'],
            [[ 'IndividualObjectiveId', 'weight'], 'integer'],
            [['ExpectedOutPut', 'TaskDescription', 'ResourcesRequired', 'KPI'], 'string'],
            [['Timeline'], 'safe'],
            [['IndividualObjectiveId'], 'exist', 'skipOnError' => true, 'targetClass' => IndividualObjectives::className(), 'targetAttribute' => ['IndividualObjectiveId' => 'IndividualObjectiveId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TaskId' => 'Task ID',
            'TaskDescription' => 'Task Description',
            'IndividualObjectiveId' => 'Individual Objective ID',
            'ExpectedOutPut' => 'Expected Out Put',
            'ResourcesRequired' => 'Resources Required',
            'KPI' => 'Kpi',
            'weight' => 'Weight',
            'Timeline' => 'Timeline',
        ];
    }

    /**
     * Gets query for [[IndividualObjective]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndividualObjective()
    {
        return $this->hasOne(IndividualObjectives::className(), ['IndividualObjectiveId' => 'IndividualObjectiveId']);
    }


}
