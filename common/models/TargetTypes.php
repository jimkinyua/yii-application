<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "TargetTypes".
 *
 * @property int $TargetTypeId
 * @property string $TargetType
 *
 * @property EvaluateTargets[] $evaluateTargets
 * @property JobGroupTargetTypes[] $jobGroupTargetTypes
 * @property Targets[] $targets
 */
class TargetTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TargetTypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TargetType'], 'required'],
            [['TargetType'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TargetTypeId' => 'Target Type ID',
            'TargetType' => 'Target Type',
        ];
    }

    /**
     * Gets query for [[EvaluateTargets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluateTargets()
    {
        return $this->hasMany(EvaluateTargets::className(), ['TargetTypeId' => 'TargetTypeId']);
    }

    /**
     * Gets query for [[JobGroupTargetTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobGroupTargetTypes()
    {
        return $this->hasMany(JobGroupTargetTypes::className(), ['TargetTypeId' => 'TargetTypeId']);
    }

    /**
     * Gets query for [[Targets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTargets()
    {
        return $this->hasMany(Targets::className(), ['TargetTypeId' => 'TargetTypeId']);
    }
}
