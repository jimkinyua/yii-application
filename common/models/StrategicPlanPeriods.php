<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "StrategicPlanPeriods".
 *
 * @property int $PlanId
 * @property string $Name
 *
 * @property CorporateWorkPlan[] $corporateWorkPlans
 * @property StrategicObjectives[] $strategicObjectives
 */
class StrategicPlanPeriods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'StrategicPlanPeriods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['Name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PlanId' => 'Plan ID',
            'Name' => 'Name',
        ];
    }

    /**
     * Gets query for [[CorporateWorkPlans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorporateWorkPlans()
    {
        return $this->hasMany(CorporateWorkPlan::className(), ['StrategicPlanId' => 'PlanId']);
    }

    /**
     * Gets query for [[StrategicObjectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrategicObjectives()
    {
        return $this->hasMany(StrategicObjectives::className(), ['StrategicPlanId' => 'PlanId']);
    }
}
