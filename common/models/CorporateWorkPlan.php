<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "CorporateWorkPlan".
 *
 * @property int $CorporateWorkPlanId
 * @property int $StrategicPlanId
 * @property int|null $Status
 * @property string|null $Code
 * @property string|null $Description
 *
 * @property CorporateStrategicObjectives[] $corporateStrategicObjectives
 * @property StrategicPlanPeriods $strategicPlan
 * @property DepartmentWorkPlans[] $departmentWorkPlans
 */
class CorporateWorkPlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CorporateWorkPlan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StrategicPlanId',], 'required'],
            [['StrategicPlanId', 'Status' ], 'integer'],
            [['Code', 'Description'], 'string'],
            [['Status'], 'default', 'value'=> 0], //Open
            [['Code'], 'default', 'value'=> 'WORKPLAN_'.date('Y').'_'.rand(5, 100)], //Open
            [['StrategicPlanId'], 'exist', 'skipOnError' => true, 'targetClass' => StrategicPlanPeriods::className(), 'targetAttribute' => ['StrategicPlanId' => 'PlanId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CorporateWorkPlanId' => 'Corporate Work Plan ID',
            'StrategicPlanId' => 'Strategic Plan ID',
            'Status' => 'Status',
            'Code' => 'Code',
            'Description' => 'Description',
        ];
    }

    /**
     * Gets query for [[CorporateStrategicObjectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorporateStrategicObjectives()
    {
        return $this->hasMany(CorporateStrategicObjectives::className(), ['CorporateWorkPlanId' => 'CorporateWorkPlanId']);
    }

    /**
     * Gets query for [[StrategicPlan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrategicPlan()
    {
        return $this->hasOne(StrategicPlanPeriods::className(), ['PlanId' => 'StrategicPlanId']);
    }

    /**
     * Gets query for [[DepartmentWorkPlans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentWorkPlans()
    {
        return $this->hasMany(DepartmentWorkPlans::className(), ['CorporateWorkPlanId' => 'CorporateWorkPlanId']);
    }
}
