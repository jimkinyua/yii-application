<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "EvaluationTypes".
 *
 * @property int $EvaluationTypeId
 * @property string $Description
 * @property string $StartDate
 * @property string $EndDate
 * @property string $Deadline
 * @property int $AppraisalPeriodId
 *
 * @property Evaluations[] $evaluations
 * @property AppraisalPeriods $appraisalPeriod
 */
class EvaluationTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'EvaluationTypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Description', 'StartDate', 'EndDate', 'Deadline', 'AppraisalPeriodId'], 'required'],
            [['Description'], 'string'],
            [['StartDate', 'EndDate', 'Deadline'], 'safe'],
            [['AppraisalPeriodId'], 'integer'],
            [['AppraisalPeriodId'], 'exist', 'skipOnError' => true, 'targetClass' => AppraisalPeriods::className(), 'targetAttribute' => ['AppraisalPeriodId' => 'AppraisalPeriodId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'EvaluationTypeId' => 'Evaluation Type ID',
            'Description' => 'Description',
            'StartDate' => 'Start Date',
            'EndDate' => 'End Date',
            'Deadline' => 'Deadline',
            'AppraisalPeriodId' => 'Appraisal Period ID',
        ];
    }

    /**
     * Gets query for [[Evaluations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluations()
    {
        return $this->hasMany(Evaluations::className(), ['EvaluationTypeId' => 'EvaluationTypeId']);
    }

    /**
     * Gets query for [[AppraisalPeriod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppraisalPeriod()
    {
        return $this->hasOne(AppraisalPeriods::className(), ['AppraisalPeriodId' => 'AppraisalPeriodId']);
    }
}
