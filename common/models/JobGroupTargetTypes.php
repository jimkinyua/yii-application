<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "JobGroupTargetTypes".
 *
 * @property int $Id
 * @property int $JobGroupId
 * @property int $TargetTypeId
 *
 * @property TargetTypes $targetType
 * @property JobGroups $jobGroup
 */
class JobGroupTargetTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'JobGroupTargetTypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['JobGroupId', 'TargetTypeId'], 'required'],
            [['TargetTypeId'], 'integer'],
            [['TargetTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => TargetTypes::className(), 'targetAttribute' => ['TargetTypeId' => 'TargetTypeId']],
            // [['JobGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => NavisionJobGroups::className(), 'targetAttribute' => ['JobGroupId' => 'Scale']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'JobGroupId' => 'Job Group ID',
            'TargetTypeId' => 'Target Type ID',
        ];
    }

    /**
     * Gets query for [[TargetType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTargetType()
    {
        return $this->hasOne(TargetTypes::className(), ['TargetTypeId' => 'TargetTypeId']);
    }

    /**
     * Gets query for [[JobGroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobGroup()
    {
        return $this->hasOne(JobGroups::className(), ['JobId' => 'JobGroupId']);
    }
}
