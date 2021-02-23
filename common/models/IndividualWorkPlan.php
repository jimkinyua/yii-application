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
 * @property int $DeptObjvId
 *
 * @property IndividualObjectives[] $individualObjectives
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
            [['Code', 'Description'], 'string'],
            [['DeptWorkPlanId'], 'integer'],
            [['Status'], 'default', 'value'=> 0], //Open
            [['Code'], 'default', 'value'=> 'INDIV_WORKPLAN_'.date('Y').'_'.rand(5, 100)], //Open
            [['EmpNo'], 'string', 'max' => 50],
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
            'DeptWorkPlanId' => 'Deprtment Work Plan ',
            'RejectReason'=> 'Reason for Rejection',
        ];
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
