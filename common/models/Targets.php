<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Targets".
 *
 * @property int $TargetId
 * @property string $TargetDescription
 * @property int $TargetTypeId
 *
 * @property TargetTypes $targetType
 */
class Targets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Targets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TargetDescription', 'TargetTypeId'], 'required'],
            [['TargetDescription'], 'string'],
            [['TargetTypeId'], 'integer'],
            [['TargetTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => TargetTypes::className(), 'targetAttribute' => ['TargetTypeId' => 'TargetTypeId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TargetId' => 'Target ID',
            'TargetDescription' => 'Target Description',
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
}
