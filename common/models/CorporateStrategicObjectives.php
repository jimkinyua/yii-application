<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "CorporateStrategicObjectives".
 *
 * @property int $CorporateObjectiveId
 * @property int $CorporateWorkPlanId
 * @property int $StrategicObjectiveId
 *
 * @property StrategicObjectives $strategicObjective
 */
class CorporateStrategicObjectives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CorporateStrategicObjectives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CorporateWorkPlanId', 'StrategicObjectiveId'], 'required'],
            // ['StrategicObjectiveId', 'unique'],
            [['CorporateWorkPlanId', 'StrategicObjectiveId'], 'integer'],
            [['StrategicObjectiveId'], 'exist', 'skipOnError' => true, 'targetClass' => StrategicObjectives::className(), 'targetAttribute' => ['StrategicObjectiveId' => 'StrategicObjectiveId']],
        
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CorporateObjectiveId' => 'Corporate Objective ID',
            'CorporateWorkPlanId' => 'Corporate Work Plan ID',
            'StrategicObjectiveId' => 'Strategic Objective ID',
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
    
    public function getObjectiveName()
    {
        $Description = StrategicObjectives::find()
            ->select(['ObjectiveName'])
            ->where(['StrategicObjectiveId' => $this->{'StrategicObjectiveId'}])
            ->asArray()
            ->one();
        $Description = $Description['ObjectiveName'];
        return $Description;
    }
}
