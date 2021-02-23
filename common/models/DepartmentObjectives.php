<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "DepartmentObjectives".
 *
 * @property int $DepartmentObjectiveId
 * @property string $ObjectiveName
 * @property int $StrategicObjectiveId
 * @property int $DepartmentId
 * @property int $DepartmentWorkPlanId
 *
 * @property StrategicObjectives $strategicObjective
 * @property DepartmentWorkPlans $departmentWorkPlan
 * @property IndividualObjectives[] $individualObjectives
 */
class DepartmentObjectives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'DepartmentObjectives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StrategicObjectiveId', 'ObjectiveName','DepartmentId', 'DepartmentWorkPlanId'], 'required'],
            [['ObjectiveName'], 'string'],
            [['StrategicObjectiveId', 'DepartmentId', 'DepartmentWorkPlanId'], 'integer'],
            [['StrategicObjectiveId'], 'exist', 'skipOnError' => true, 'targetClass' => StrategicObjectives::className(), 'targetAttribute' => ['StrategicObjectiveId' => 'StrategicObjectiveId']],
            [['DepartmentWorkPlanId'], 'exist', 'skipOnError' => true, 'targetClass' => DepartmentWorkPlans::className(), 'targetAttribute' => ['DepartmentWorkPlanId' => 'DepartmentWorkPlanId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DepartmentObjectiveId' => 'Department Objective ID',
            'ObjectiveName' => 'Department Objective',
            'StrategicObjectiveId' => 'Strategic Objective ID',
            'DepartmentId' => 'Department ID',
            'DepartmentWorkPlanId' => 'Department Work Plan ID',
        ];
    }

    /**
     * Gets query for [[StrategicObjective]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStrategicObjective()
    {
        return $this->hasOne(StrategicObjectives::className(), ['StrategicObjectiveId' => 'StrategicObjectiveId']);
    }

    /**
     * Gets query for [[DepartmentWorkPlan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentWorkPlan()
    {
        return $this->hasOne(DepartmentWorkPlans::className(), ['DepartmentWorkPlanId' => 'DepartmentWorkPlanId']);
    }

    /**
     * Gets query for [[IndividualObjectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndividualObjectives()
    {
        return $this->hasMany(IndividualObjectives::className(), ['DeptObjectiveId' => 'DepartmentObjectiveId']);
    }
}
