<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "DepartmentWorkPlans".
 *
 * @property int $DepartmentWorkPlanId
 * @property int $CorporateWorkPlanId
 *
 * @property DepartmentObjectives[] $departmentObjectives
 * @property CorporateWorkPlan $corporateWorkPlan
 * @property IndividualObjectives[] $individualObjectives
 */
class DepartmentWorkPlans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'DepartmentWorkPlans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CorporateWorkPlanId', 'Description',], 'required'],
            [['CorporateWorkPlanId'], 'integer'],
            [['Status'], 'default', 'value'=> 0], //Open
            [['Code'], 'default', 'value'=> 'DEPT_WORKPLAN_'.date('Y').'_'.rand(5, 100)], //Open
            [['CorporateWorkPlanId'], 'exist', 'skipOnError' => true, 'targetClass' => CorporateWorkPlan::className(), 'targetAttribute' => ['CorporateWorkPlanId' => 'CorporateWorkPlanId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DepartmentWorkPlanId' => 'Department Work Plan ID',
            'CorporateWorkPlanId' => 'Corporate Work Plan ID',
            'Description'=>'Department Work Plan Description',
        ];
    }

    /**
     * Gets query for [[DepartmentObjectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentObjectives()
    {
        return $this->hasMany(DepartmentObjectives::className(), ['DepartmentWorkPlanId' => 'DepartmentWorkPlanId']);
    }

    /**
     * Gets query for [[CorporateWorkPlan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorporateWorkPlan()
    {
        return $this->hasOne(CorporateWorkPlan::className(), ['CorporateWorkPlanId' => 'CorporateWorkPlanId']);
    }

    /**
     * Gets query for [[IndividualObjectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndividualObjectives()
    {
        return $this->hasMany(IndividualObjectives::className(), ['DepartmentWorkPlanId' => 'DepartmentWorkPlanId']);
    }
    
}
