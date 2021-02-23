<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appraisal_period".
 *
 * @property int $id
 * @property string $period_code
 * @property string $start_date
 * @property string $end_date
 *
 * @property Evaluations[] $evaluations
 */
class AppraisalPeriod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'appraisal_period';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['period_code', 'start_date', 'end_date'], 'required'],
            [['period_code'], 'string'],
            [['start_date', 'end_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'period_code' => 'Period Code',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluations()
    {
        return $this->hasMany(Evaluations::className(), ['appraisal_period_id' => 'id']);
    }
}
