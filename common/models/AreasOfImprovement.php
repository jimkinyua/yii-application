<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "AreasOfImprovement".
 *
 * @property int $AreaImprovementId
 * @property int $KeyResultId
 * @property string $Description
 * @property string $EmpNo
 * @property int|null $AppraisalPeriodid
 * @property int|null $AppraiseeScore
 * @property int|null $SupervisorScore
 * @property int|null $Addressed
 *
 * @property KeyResultAreas $keyResult
 * @property AppraisalPeriods $appraisalPeriod
 */
class AreasOfImprovement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AreasOfImprovement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KeyResultId', 'Description', 'EmpNo'], 'required'],
            [['AreaImprovementId', 'KeyResultId', 'AppraisalPeriodid', 'AppraiseeScore', 'SupervisorScore', 'Addressed'], 'integer'],
            [['Description'], 'string'],
            [['EmpNo'], 'string', 'max' => 50],
            [['AreaImprovementId'], 'unique'],
            [['KeyResultId'], 'exist', 'skipOnError' => true, 'targetClass' => KeyResultAreas::className(), 'targetAttribute' => ['KeyResultId' => 'KeyResultAreaId']],
            [['AppraisalPeriodid'], 'exist', 'skipOnError' => true, 'targetClass' => AppraisalPeriods::className(), 'targetAttribute' => ['AppraisalPeriodid' => 'AppraisalPeriodId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AreaImprovementId' => 'Area Improvement ID',
            'KeyResultId' => 'Key Result ID',
            'Description' => 'Description',
            'EmpNo' => 'Emp No',
            'AppraisalPeriodid' => 'Appraisal Periodid',
            'AppraiseeScore' => 'Appraisee Score',
            'SupervisorScore' => 'Supervisor Score',
            'Addressed' => 'Addressed',
        ];
    }

    /**
     * Gets query for [[KeyResult]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKeyResult()
    {
        return $this->hasOne(KeyResultAreas::className(), ['KeyResultAreaId' => 'KeyResultId']);
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
