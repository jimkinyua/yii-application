<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "IndividualObjectives".
 *
 * @property int $IndividualObjectiveId
 * @property string $IndividualObjectiveName
 * @property int $IndvidualWorkplanId
 * @property int $workplan_weight
 * @property int $DepartmentObjId
 *
 * @property DepartmentObjectives $departmentObj
 * @property IndividualWorkPlan $indvidualWorkplan
 * @property Tasks[] $tasks
 */
class IndividualObjectives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'IndividualObjectives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IndividualObjectiveName', 'IndvidualWorkplanId', 'workplan_weight', 'DepartmentObjId'], 'required'],
            [['IndividualObjectiveName'], 'string'],
            [['IndvidualWorkplanId', 'workplan_weight', 'DepartmentObjId'], 'integer'],
            [['DepartmentObjId'], 'exist', 'skipOnError' => true, 'targetClass' => DepartmentObjectives::className(), 'targetAttribute' => ['DepartmentObjId' => 'DepartmentObjectiveId']],
            [['IndvidualWorkplanId'], 'exist', 'skipOnError' => true, 'targetClass' => IndividualWorkPlan::className(), 'targetAttribute' => ['IndvidualWorkplanId' => 'IndividualWorkPlanId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IndividualObjectiveId' => 'Individual Objective ID',
            'IndividualObjectiveName' => 'Individual Objective Name',
            'IndvidualWorkplanId' => 'Indvidual Workplan ID',
            'workplan_weight' => 'Workplan Weight',
            'DepartmentObjId' => 'Department Obj ID',
        ];
    }

    /**
     * Gets query for [[DepartmentObj]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentObj()
    {
        return $this->hasOne(DepartmentObjectives::className(), ['DepartmentObjectiveId' => 'DepartmentObjId']);
    }

    /**
     * Gets query for [[IndvidualWorkplan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndvidualWorkplan()
    {
        return $this->hasOne(IndividualWorkPlan::className(), ['IndividualWorkPlanId' => 'IndvidualWorkplanId']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['IndividualObjectiveId' => 'IndividualObjectiveId']);
    }

    public  function getTotalWeight($DeptObjId){
        return $this->find()->where(['DepartmentObjId'=>$DeptObjId])->sum('workplan_weight');
    }

    
    public  function getTaskTotalWeight(){
        return Tasks::find()->where(['IndividualObjectiveId'=>$this->IndividualObjectiveId])->sum('weight');
    }

    public function getTotalTaskWeightedScore(){
        return Tasks::find()
        ->where(['IndividualObjectiveId'=>$this->IndividualObjectiveId])
        ->sum('AgreedScore * (weight/100)');

    }

}
