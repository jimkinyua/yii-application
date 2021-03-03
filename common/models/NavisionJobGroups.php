<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jobLevels".
 *
 * @property int $id
 * @property int $job_level
 */
class NavisionJobGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
       // return 'jobLevels';
        return \Yii::$app->params['Company'].'Salary Scales1 ';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Scale'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            //'job_level' => 'Job Level',
            'Scale'=>'Grade',
        ];
    }
     public static function getDb()
    {
        return Yii::$app->get('db_nav');
    }

    public function getJobGroupTargetTypes()
    {
        return $this->hasMany(JobGroupTargetTypes::className(), ['JobGroupId' => 'Scale']);
    }
}
