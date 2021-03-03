<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "StrategicPlanPeriods".
 *
 * @property int $PlanId
 * @property string $Name
 *
 * @property AppraisalPeriods[] $appraisalPeriods
 * @property CorporateWorkPlan[] $corporateWorkPlans
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
     * Gets query for [[AppraisalPeriods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppraisalPeriods()
    {
        return $this->hasMany(AppraisalPeriods::className(), ['StarategicPlanPeriod' => 'PlanId']);
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
}
