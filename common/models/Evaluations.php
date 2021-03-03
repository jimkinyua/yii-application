<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Evaluations".
 *
 * @property int $EvaluationId
 * @property int $WorkPlanId
 * @property int $AppraisalPeriodid
 * @property int $Status
 * @property int $Contested
 * @property int $EvaluationTypeId
 * @property string $EmpNo
 * @property string $Code
 * @property string|null $ImmediateSupervisor
 *
 * @property EvaluateTargets[] $evaluateTargets
 * @property IndividualWorkPlan $workPlan
 * @property AppraisalPeriods $appraisalPeriod
 * @property EvaluationTypes $evaluationType
 * @property KeyResultAreas[] $keyResultAreas
 */
class Evaluations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Evaluations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['WorkPlanId', 'AppraisalPeriodid',  'Contested', 'EvaluationTypeId', 'EmpNo',], 'required'],
            [['WorkPlanId', 'AppraisalPeriodid', 'Status', 'Contested', 'EvaluationTypeId'], 'integer'],
            [['Code'], 'string'],
            [['Status'], 'default', 'value'=> 0], //Open
            [['Code'], 'default', 'value'=> 'EVAL_'.date('Y').'_'.rand(5, 100)], 
            [['EmpNo', 'ImmediateSupervisor'], 'string', 'max' => 50],
            [['WorkPlanId'], 'exist', 'skipOnError' => true, 'targetClass' => IndividualWorkPlan::className(), 'targetAttribute' => ['WorkPlanId' => 'IndividualWorkPlanId']],
            [['AppraisalPeriodid'], 'exist', 'skipOnError' => true, 'targetClass' => AppraisalPeriods::className(), 'targetAttribute' => ['AppraisalPeriodid' => 'AppraisalPeriodId']],
            [['EvaluationTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => EvaluationTypes::className(), 'targetAttribute' => ['EvaluationTypeId' => 'EvaluationTypeId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'EvaluationId' => 'Evaluation ID',
            'WorkPlanId' => 'Work Plan ID',
            'AppraisalPeriodid' => 'Appraisal Periodid',
            'Status' => 'Status',
            'Contested' => 'Contested',
            'EvaluationTypeId' => 'Evaluation Type ID',
            'EmpNo' => 'Emp No',
            'Code' => 'Code',
            'ImmediateSupervisor' => 'Immediate Supervisor',
        ];
    }

    /**
     * Gets query for [[EvaluateTargets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluateTargets()
    {
        return $this->hasMany(EvaluateTargets::className(), ['EvaluationId' => 'EvaluationId']);
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
     * Gets query for [[AppraisalPeriod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppraisalPeriod()
    {
        return $this->hasOne(AppraisalPeriods::className(), ['AppraisalPeriodId' => 'AppraisalPeriodid']);
    }

    /**
     * Gets query for [[EvaluationType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluationType()
    {
        return $this->hasOne(EvaluationTypes::className(), ['EvaluationTypeId' => 'EvaluationTypeId']);
    }

    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['EvaluationId' => 'EvaluationId']);
    }

    /**
     * Gets query for [[KeyResultAreas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKeyResultAreas()
    {
        return $this->hasMany(KeyResultAreas::className(), ['EvaluationId' => 'EvaluationId']);
    }

    public function getSoftSkills()
    {
        return   EvaluateTargets::find()
         ->where(['TargetTypeId'=>2, 'EvaluationId'=>$this->EvaluationId])
         ->all();
    }

    public function getCoreValues()
    {
        return   EvaluateTargets::find()
         ->where(['TargetTypeId'=>1, 'EvaluationId'=>$this->EvaluationId])
         ->all();
    }

    public function getPerfomanceSkills()
    {
        return   EvaluateTargets::find()
         ->where(['TargetTypeId'=>4 , 'EvaluationId'=>$this->EvaluationId])
         ->all();
    }

      /**
     * Gets query for [[EvaluateTargetImprovementAreas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluateTargetImprovementAreas()
    {
        return $this->hasMany(EvaluateTargetImprovementAreas::className(), ['EvaluationId' => 'EvaluationId']);
    }

      /**
     * Gets query for [[EvaluateTasksImprovementAreas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluateTasksImprovementAreas()
    {
        return $this->hasMany(EvaluateTasksImprovementAreas::className(), ['EvaluationId' => 'EvaluationId']);
    }

    public function getResults()
    {
        return $this->hasMany(Results::className(), ['EvaluationId' => 'EvaluationId']);
    }
}
