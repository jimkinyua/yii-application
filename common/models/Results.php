<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Results".
 *
 * @property int $Id
 * @property int $EvaluationId
 * @property string $EmployeeNo
 * @property string $EmployeeDepartment
 * @property string $JobLevel
 * @property int $AppraisalPeriodId
 * @property int $EvaluationType
 * @property string $Designation
 * @property string $Supervisor
 * @property string $SupervisorDesignation
 * @property int $Rating
 * @property int $WorkPlanScore
 * @property int $SoftSkillsScore
 * @property int $PerformanceSkillsScore
 * @property int $CoreValuesScore
 * @property int $Excellent
 *
 * @property Evaluations $evaluation
 * @property AppraisalPeriods $appraisalPeriod
 */
class Results extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Results';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['EvaluationId', 'EmployeeNo', 'AppraisalPeriodId', 'EvaluationType', 'Supervisor',  'Rating', 'WorkPlanScore', 'SoftSkillsScore', 'PerformanceSkillsScore', 'CoreValuesScore', 'Excellent'], 'required'],
            [['EvaluationId', 'AppraisalPeriodId', 'EvaluationType', 'Rating', 'WorkPlanScore', 'SoftSkillsScore', 'PerformanceSkillsScore', 'CoreValuesScore', 'Excellent'], 'integer'],
            [['EmployeeNo', 'EmployeeDepartment', 'Designation', 'Supervisor', 'SupervisorDesignation'], 'string'],
            [['JobLevel'], 'string', 'max' => 50],
            [['EvaluationId'], 'exist', 'skipOnError' => true, 'targetClass' => Evaluations::className(), 'targetAttribute' => ['EvaluationId' => 'EvaluationId']],
            [['AppraisalPeriodId'], 'exist', 'skipOnError' => true, 'targetClass' => AppraisalPeriods::className(), 'targetAttribute' => ['AppraisalPeriodId' => 'AppraisalPeriodId']],
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
            'EmployeeNo' => 'Employee No',
            'EmployeeDepartment' => 'Employee Department',
            'JobLevel' => 'Job Level',
            'AppraisalPeriodId' => 'Appraisal Period ID',
            'EvaluationType' => 'Evaluation Type',
            'Designation' => 'Designation',
            'Supervisor' => 'Supervisor',
            'SupervisorDesignation' => 'Supervisor Designation',
            'Rating' => 'Rating',
            'WorkPlanScore' => 'Work Plan Score',
            'SoftSkillsScore' => 'Soft Skills Score',
            'PerformanceSkillsScore' => 'Performance Skills Score',
            'CoreValuesScore' => 'Core Values Score',
            'Excellent' => 'Excellent',
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
     * Gets query for [[AppraisalPeriod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppraisalPeriod()
    {
        return $this->hasOne(AppraisalPeriods::className(), ['AppraisalPeriodId' => 'AppraisalPeriodId']);
    }
}
