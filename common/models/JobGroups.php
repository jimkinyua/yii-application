<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "JobGroups".
 *
 * @property int $JobId
 * @property int $JobGroup
 *
 * @property JobGroupTargetTypes[] $jobGroupTargetTypes
 */
class JobGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'JobGroups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['JobGroup'], 'required'],
            [['JobGroup'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'JobId' => 'Job ID',
            'JobGroup' => 'Job Group',
        ];
    }

    /**
     * Gets query for [[JobGroupTargetTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobGroupTargetTypes()
    {
        return $this->hasMany(JobGroupTargetTypes::className(), ['JobGroupId' => 'JobId']);
    }
}
