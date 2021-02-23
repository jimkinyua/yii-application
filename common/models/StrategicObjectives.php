<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "StrategicObjectives".
 *
 * @property int $StrategicObjectiveId
 * @property string $ObjectiveName
 * @property int $StrategicPlanId
 *
 * @property CorporateStrategicObjectives[] $corporateStrategicObjectives
 * @property DepartmentObjectives[] $departmentObjectives
 * @property StrategicPlanPeriods $strategicPlan
 */
class StrategicObjectives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'StrategicObjectives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ObjectiveName', 'StrategicPlanId'], 'required'],
            [['ObjectiveName'], 'string'],
            [['StrategicPlanId'], 'integer'],
            [['StrategicPlanId'], 'exist', 'skipOnError' => true, 'targetClass' => StrategicPlanPeriods::className(), 'targetAttribute' => ['StrategicPlanId' => 'PlanId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'StrategicObjectiveId' => 'Strategic Objective ID',
            'ObjectiveName' => 'Strategic Objective Name',
            'StrategicPlanId' => 'Strategic Period',
        ];
    }

    /**
     * Gets query for [[CorporateStrategicObjectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCorporateStrategicObjectives()
    {
        return $this->hasMany(CorporateStrategicObjectives::className(), ['StrategicObjectiveId' => 'StrategicObjectiveId']);
    }

    /**
     * Gets query for [[DepartmentObjectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentObjectives()
    {
        return $this->hasMany(DepartmentObjectives::className(), ['StrategicObjectiveId' => 'StrategicObjectiveId']);
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

    public function getObjectiveName()
    {
        return $this->ObjectiveName;
    }

}
