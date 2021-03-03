<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "TargetImprovementAreas".
 *
 * @property int $Id
 * @property int $TargetId
 * @property string $Description
 * @property string $EmpNo
 * @property int $AppraisalPeriodid
 * @property int $AppraiseeScore
 * @property int $SupervisorScore
 * @property int $Addressed
 *
 * @property EvaluateTargets $target
 * @property AppraisalPeriods $appraisalPeriod
 */
class TargetImprovementAreas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TargetImprovementAreas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TargetId', 'Description', 'EmpNo', 'AppraisalPeriodid', 'Addressed'], 'required'],
            [['TargetId', 'AppraisalPeriodid', 'AppraiseeScore', 'SupervisorScore', 'Addressed'], 'integer'],
            [['Description'], 'string'],
            [['EmpNo'], 'string', 'max' => 10],
            [['TargetId'], 'exist', 'skipOnError' => true, 'targetClass' => EvaluateTargets::className(), 'targetAttribute' => ['TargetId' => 'Id']],
            [['AppraisalPeriodid'], 'exist', 'skipOnError' => true, 'targetClass' => AppraisalPeriods::className(), 'targetAttribute' => ['AppraisalPeriodid' => 'AppraisalPeriodId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'TargetId' => 'Target ID',
            'Description' => 'Description',
            'EmpNo' => 'Emp No',
            'AppraisalPeriodid' => 'Appraisal Periodid',
            'AppraiseeScore' => 'Appraisee Score',
            'SupervisorScore' => 'Supervisor Score',
            'Addressed' => 'Addressed',
        ];
    }

    /**
     * Gets query for [[Target]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTarget()
    {
        return $this->hasOne(EvaluateTargets::className(), ['Id' => 'TargetId']);
    }

    /**
     * Gets query for [[AppraisalPeriod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppraisalPeriod()
    {
        return $this->hasOne(AppraisalPeriods::className(), ['AppraisalPeriodId' => 'AppraisalPeriodid']);
    }
}
