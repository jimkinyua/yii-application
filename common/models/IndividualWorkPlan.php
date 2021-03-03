<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "IndividualWorkPlan".
 *
 * @property int $IndividualWorkPlanId
 * @property string $Code
 * @property string $Description
 * @property string $EmpNo
 * @property int $DeptWorkPlanId
 * @property int|null $Status
 * @property string|null $ImmediateSupervisor
 * @property string|null $RejectReason
 * @property string|null $ApprovalDate
 *
 * @property Evaluations[] $evaluations
 * @property IndividualObjectives[] $individualObjectives
 * @property DepartmentWorkPlans $deptWorkPlan
 */
class IndividualWorkPlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'IndividualWorkPlan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Description', 'EmpNo', 'DeptWorkPlanId'], 'required'],
            [['Code', 'Description', 'RejectReason'], 'string'],
            [['DeptWorkPlanId', 'Status'], 'integer'],
            [['ApprovalDate'], 'safe'],
            [['Status'], 'default', 'value'=> 0], //Open
            [['Code'], 'default', 'value'=> 'INDIVIPLAN_'.date('Y').'_'.rand(5, 100)], //Open
            [['EmpNo', 'ImmediateSupervisor'], 'string', 'max' => 50],
            [['DeptWorkPlanId'], 'exist', 'skipOnError' => true, 'targetClass' => DepartmentWorkPlans::className(), 'targetAttribute' => ['DeptWorkPlanId' => 'DepartmentWorkPlanId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IndividualWorkPlanId' => 'Individual Work Plan ID',
            'Code' => 'Code',
            'Description' => 'Description',
            'EmpNo' => 'Emp No',
            'DeptWorkPlanId' => 'Dept Work Plan ID',
            'Status' => 'Status',
            'ImmediateSupervisor' => 'Immediate Supervisor',
            'RejectReason' => 'Reject Reason',
            'ApprovalDate' => 'Approval Date',
        ];
    }

    /**
     * Gets query for [[Evaluations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluations()
    {
        return $this->hasMany(Evaluations::className(), ['WorkPlanId' => 'IndividualWorkPlanId']);
    }

    /**
     * Gets query for [[IndividualObjectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndividualObjectives()
    {
        return $this->hasMany(IndividualObjectives::className(), ['IndvidualWorkplanId' => 'IndividualWorkPlanId']);
    }

    /**
     * Gets query for [[DeptWorkPlan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeptWorkPlan()
    {
        return $this->hasOne(DepartmentWorkPlans::className(), ['DepartmentWorkPlanId' => 'DeptWorkPlanId']);
    }
}
