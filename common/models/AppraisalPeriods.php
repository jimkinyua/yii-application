<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "AppraisalPeriods".
 *
 * @property int $AppraisalPeriodId
 * @property resource $Description
 * @property string $StartDate
 * @property string $EndDate
 * @property int $StarategicPlanPeriod
 *
 * @property StrategicPlanPeriods $starategicPlanPeriod
 * @property Evaluations[] $evaluations
 * @property EvaluationTypes[] $evaluationTypes
 */
class AppraisalPeriods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AppraisalPeriods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Description', 'StartDate', 'EndDate', 'StarategicPlanPeriod'], 'required'],
            [['StartDate', 'EndDate'], 'safe'],
            [['StarategicPlanPeriod'], 'integer'],
            [['Description'], 'string', 'max' => 50],
            [['StarategicPlanPeriod'], 'exist', 'skipOnError' => true, 'targetClass' => StrategicPlanPeriods::className(), 'targetAttribute' => ['StarategicPlanPeriod' => 'PlanId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppraisalPeriodId' => 'Appraisal Period ID',
            'Description' => 'Description',
            'StartDate' => 'Start Date',
            'EndDate' => 'End Date',
            'StarategicPlanPeriod' => 'Starategic Plan Period',
        ];
    }

    /**
     * Gets query for [[StarategicPlanPeriod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStarategicPlanPeriod()
    {
        return $this->hasOne(StrategicPlanPeriods::className(), ['PlanId' => 'StarategicPlanPeriod']);
    }

    /**
     * Gets query for [[Evaluations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluations()
    {
        return $this->hasMany(Evaluations::className(), ['AppraisalPeriodid' => 'AppraisalPeriodId']);
    }

    /**
     * Gets query for [[EvaluationTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluationTypes()
    {
        return $this->hasMany(EvaluationTypes::className(), ['AppraisalPeriodId' => 'AppraisalPeriodId']);
    }
}
